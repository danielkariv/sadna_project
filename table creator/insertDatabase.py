import mysql.connector
import csv
import json
import os

pathNetflixCSV = '../datasets/netflix_titles.csv' 
pathPosterList = '../datasets/netflix_posters.txt'
pathNamesTSV = '../datasets/name.basics.tsv'

def insertCast():
    with open(pathNetflixCSV, newline='') as csvfile:
        reader = csv.reader(csvfile)
        showPersonSet = set()
        for row in reader:
            break
        for row in reader:
            title = row[2]
            title = title.encode('utf-8', 'ignore')
            title = title.decode('utf-8', 'ignore')
            cstring = row[4]
            clist = cstring.split(",")
            for c in clist:
                c = c.strip()
                if len(c) > 0:
                    item = (title,c)
                    showPersonSet.add(item)
    
        print(len(showPersonSet))
        # Info to connect to MySQL database.
        mydb = mysql.connector.connect(
        host="localhost",
        user="root",
        database="MyNetflixList",
        )
        
        if not mydb.is_closed():
            mycursor = mydb.cursor()
            sql = "INSERT IGNORE INTO Cast (ShowID,PersonID) VALUES ((SELECT Id FROM Shows WHERE Title = %s), (SELECT Id FROM Persons WHERE Name = %s));"
            array = list(showPersonSet)
            mycursor.executemany(sql, list(showPersonSet))
            # Takes a lot of time, I guess because of the nested queries. takes 15 mins.
            mydb.commit()

            print(mycursor.rowcount, "record inserted.")
        else:
            print("Database closed!")

def insertPersons():
    persons = set()
    # extract list of all countries.
    with open(pathNetflixCSV, newline='') as csvfile:
        reader = csv.reader(csvfile) # ,delimiter=',', quotechar='|'
        for row in reader:
            break
        for row in reader:
            cstring = row[4]
            clist = cstring.split(",")
            for c in clist:
                c = c.strip()
                if len(c) > 0:
                    persons.add(c)
    # sort and shows length and data.
    persons = sorted(persons)
    print(persons)
    print(len(persons))
    Persons = set()
    with open(pathNamesTSV, newline='') as tsvfile:
        reader = csv.reader(tsvfile, delimiter="\t")
        lookingCount = len(persons)
        for row in reader:
            break
        for row in reader:
            Name = row[1]
            if not Name in persons:
                continue
            persons.remove(Name)

            if row[2] != "\\N":
                BirthYear = row[2]
            else:
                BirthYear = None
            if row[3] != "\\N":
                DeathYear = row[3]
            else:
                DeathYear = None
            
            Profession = None
            pstring = row[4]
            plist = pstring.split(",")
            for p in plist:
                p = p.strip()
                if len(c) > 0:
                    Profession = p
                    break
            Persons.add((Name,BirthYear,DeathYear,Profession))
            print("%s %s/%s" %(len(Persons)/float(lookingCount),len(Persons),lookingCount))
            # Notes: Takes about ~25 mins on a good hardware like M1 cpu.
            if len(Persons) == len(persons):
                break
    Persons = sorted(Persons)
    print(Persons)
    print(len(Persons))

    # Info to connect to MySQL database.
    mydb = mysql.connector.connect(
    host="localhost",
    user="root",
    database="MyNetflixList",
    )

    if not mydb.is_closed():
        mycursor = mydb.cursor()
        sql = "INSERT INTO Persons (Name,BirthYear,DeathYear,Profession) VALUES (%s,%s,%s,%s)"
        mycursor.executemany(sql, Persons)

        mydb.commit()

        print(mycursor.rowcount, "record inserted.")
    else:
        print("Database closed!")
    

def insertShows():
    posters = {}
    # reading the data from the file
    if os.path.isfile(pathPosterList):
        with open(pathPosterList,) as f: 
            data = f.read()
            posters = json.loads(data)
    shows = set()
    with open(pathNetflixCSV, newline='') as csvfile:
        reader = csv.reader(csvfile) # ,delimiter=',', quotechar='|'
        for row in reader:
            break
        for row in reader:
            # row = show_id,type,title,director,cast,country,date_added,release_year,rating,duration,listed_in,description
            # type
            isMovie = row[1] == "Movie"
            # title
            Title = row[2]
            # extract country
            cstring = row[5]
            clist = cstring.split(",")
            Country = None
            for c in clist:
                c = c.strip()
                
                if len(c) > 0:
                    Country = c
                    break
            # NOTE: takes first country in the list to represent show.
            # releaseYear
            ReleaseYear = int(row[7])
            # Rating
            Rating = row[8]
            # Duration
            Duration = row[9]
            # Description
            Description = row[11]
            # Poster
            Poster = posters.get(Title)
            # Fix title encoding.
            Title = Title.encode('utf-8', 'ignore')
            Title = Title.decode('utf-8', 'ignore')
            # add show to list
            shows.add((isMovie,Title,Country,ReleaseYear,Rating,Duration,Description,Poster))
    shows = sorted(shows)
    print(shows)
    print(len(shows))
    
    # Info to connect to MySQL database.
    mydb = mysql.connector.connect(
    host="localhost",
    user="root",
    database="MyNetflixList",
    )

    if not mydb.is_closed():
        mycursor = mydb.cursor()
        sql = "INSERT INTO Shows (isMovie,Title,CountryID,ReleaseYear,Rating,Duration,Description,Poster) VALUES (%s,%s,(SELECT Id FROM Countries WHERE Name = %s),%s,%s,%s,%s,%s)"
        mycursor.executemany(sql, shows)

        mydb.commit()

        print(mycursor.rowcount, "record inserted.")
    else:
        print("Database closed!")
    
    

def insertCountries():
    ''' Finds all unique countries and try to insert them to database.'''
    countries = set()
    # extract list of all countries.
    with open(pathNetflixCSV, newline='') as csvfile:
        reader = csv.reader(csvfile) # ,delimiter=',', quotechar='|'
        for row in reader:
            break
        for row in reader:
            cstring = row[5]
            clist = cstring.split(",")
            for c in clist:
                c = c.strip()
                if len(c) > 0:
                    countries.add((c,))
    # sort and shows length and data.
    countries = sorted(countries)
    print(sorted(countries))
    print(len(countries))

    # Info to connect to MySQL database.
    mydb = mysql.connector.connect(
    host="localhost",
    user="root",
    database="MyNetflixList",
    )

    if not mydb.is_closed():
        mycursor = mydb.cursor()
        sql = "INSERT INTO Countries (Name) VALUES (%s)"
        mycursor.executemany(sql, countries)

        mydb.commit()

        print(mycursor.rowcount, "record inserted.")
    else:
        print("Database closed!")

# NOTE: run each function one by one, to make sure nothing crashing while running.
# insert countries -> shows -> people -> relation between people.
#insertCountries()
#insertShows()
#insertPersons()
#insertCast()