##### Notes
Ctr+Click a notification to mark all current notifications as seen<br>
Ctrl+Click a toast to clear all current toasts
# JesNic Standards
## 1 - Coding
### 1.1 - Naming
File and variable names are written in camelCase style, meaning words directly follow each other, starting with a capital letter. The name ought to be appropriate and should describe it's purpose. Abbreviations for small scopes such as for-loops are tolerated. Libraries and/or modular files may start with _ or their index followed by _ to indicate that it's a module.
### 1.2 - Commenting
Code may be commented for better understanding, but it is not required.
## 2 - API
### 2.1 Interface
Interface URL: JesNic/api/interface.php

| Action | Goal |
| :---: | :---: |
| Login | 00 |
| Logout | 01 |
| generateToken | 02 |
| registerModule | 04 |
| modifyModule | 05 |
| insertData | 06 |
| verifyMatch | 09 |
| getFrequency | 10 |
### 2.2 Units and IDs
Data is sent numeric without unit attached

| Sensor ID | Property | Unit |
| :---: | :----: | :---:|
|00|Temperature|°C|
|01|Humidity|%|
## 3 Git
### 3.1 GitHub
JesNic uses GitHub version control to store code. The URL for accessing GitHub is: https://github.com/jesnic/. Login Credentials can be found in the respective document on Google Drive. 
### 3.2 Frequency
After completion of an element a commit must be issued, describing the changed with keywords. A line break in the commit message indicates a new topic.
