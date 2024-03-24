#!/usr/bin/env python

import csv

f = open("seedDB.sql", "w")

f.write("CREATE DATABASE IF NOT EXISTS weather_app_db;\n");
f.write("DROP TABLE cities;");
f.write("CREATE TABLE cities (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, name VARCHAR(100) NOT NULL, city_code VARCHAR(70) NOT NULL);\n");

with open('citiesCodes.csv', mode ='r') as file:    
       csvFile = csv.DictReader(file)
       for lines in csvFile:
            codAuto = lines['CPRO']
            cmun = lines['CMUN']
            munName = lines['NOMBRE ']

            if cmun != None:
            	munName = munName.replace("'", "")
            	code = str(codAuto) + str(cmun)
            	insertDB = "INSERT INTO cities (name, city_code) VALUES ('" + munName + "', '" + code + "');\n"
            	f.write(insertDB);


print("sql file generated in root project")
