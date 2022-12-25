import requests
import json
import csv
import os.path
import sys

# script is crawrling the api with given netflix dataset titles, with api key.

limiter = 1000 # Default value (also the daliy limit of API).
pathNetflixCSV = '/Users/daniel/Downloads/netflix_titles.csv'  # TODO: hardcoded!
apikey = 'c25cad6d' # Requested and receive from OMDb API.  # TODO: hardcoded!

# TODO: adds args support, to get file paths and settings.
#       Right now, only can recieve single number for limiter.
#       Ask user for: apikey, path to csv, path where we will save crawled data, limit size
args = sys.argv[1:]
if len(args) > 0:
    limiter = int(args[0])

print("Start loading saved dictonary from past runs.")
dictonary = {}
# reading the data from the file
if os.path.isfile('list.txt'): # TODO: hardcoded!
    with open('list.txt',) as f: 
        data = f.read()
        dictonary = json.loads(data)

print("Finish loading, has %d shows saved." %len(dictonary))

print("Load and run over csv file.")
with open(pathNetflixCSV, newline='') as csvfile:
    reader = csv.reader(csvfile) # ,delimiter=',', quotechar='|'
    
    line_count = 0
    for row in reader:
        # check if we run out of runs.
        if limiter <= 0:
            break
        # edge case (we avoid first line in csv, as it is column names)
        if line_count == 0:
            line_count += 1
            continue
        
        # get show name from row.
        show_name = row[2]
        
        # check if show name already exist in dictonary, if so, skip it, and continue to next line.
        if show_name in dictonary:
            print('Skip show: %s (found url already)' %(show_name))
            continue
        
        # api request url.
        url = 'http://www.omdbapi.com/?t=%s&apikey=%s' %(show_name.replace(' ','+'),apikey)
        res = requests.get(url)
        limiter -= 1

        print(res.content)
        movie = json.loads(res.content)
	
        if movie == None or movie.get('Poster') == None:
            if movie.get('Response') == "False":
                if movie.get('Error') == "Request limit reached!":
                    print("Daily limit: reached daily limit")
                    break 
                elif movie.get('Error') == "Movie not found!":
                    print("Add show: %s (Movie not found in OMDb, set as null)" %show_name)
                    dictonary[show_name] = None
                    line_count += 1
                else:
                    print("Unknown Error! (Response=%s, Error=%s)" %(movie.get('Response'),movie.get('Error')))
            else:
                print("Unknown Error! (Response=%s, Error=%s)" %(movie.get('Response'),movie.get('Error')))
        else:
            print("Add show: %s (found poster url)" %show_name)
            dictonary[show_name] = movie['Poster']
            line_count += 1
print("Done running on csv file, start saving to file")
# Finish running, start saving.
with open('list.txt', 'w') as convert_file:  # TODO: hardcoded!
     convert_file.write(json.dumps(dictonary))
# line_count skip on the first line, so actual lines added are total - 1.
print('Done saving, added %d new shows to dictonary.' %(line_count-1))
print('Total shows we got till now is %d.' %len(dictonary))
