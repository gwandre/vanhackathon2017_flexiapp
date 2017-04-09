# vanhackathon2017_flexiapp
Vanhackathon 2017 - Flexi - Credit Report App

Description
Our challenge is to write a code to parse an XML or JSON file that is stored in a Google Drive and save the transactional data in a csv file, respecting the node structure of the original file. A new file saved on the folder triggers the code. The original file contains sensitive data, like bank statement or credit report.
 
Overview
Both files are stored in Google Drive. For this challenge, we provided 2 test data files, similarly what FlexFi is receiving after the applicant submits the loan application.
 
Files for Testing
 
Bank Statement
Description: Up to 90 transactional data
Folder: Challenge\1.JSON
Name: bank.json
Format: JSON file format
 
Credit Report
Description: Credit report
Folder: Challenge\2.XML
Name: credit_report.xls
Format: XML file format
 
https://drive.google.com/open?id=0ByD-G8tCBuktSFpRdGI3Y0hjMkE

What was made
An web application was made to easy upload xml/json file and download the result file. The system read the origin file and transform it into a CSV file.

Future
Next implementations can get the file google drive link and auto parse into a new csv file, or can write a service to get data and save into the required place.

After get more info about origin files and destination software, we can talk about integration services and more other ways to get it automated.

Used resources
 - Centos Linux
 - Apache Server (httpd)
 - PHP
 - PHP JSON Parser
 - PHP Simple XML Parser

Try this live test link
http://vanhackathon2017.guilhermeandre.com.br/