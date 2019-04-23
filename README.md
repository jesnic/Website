# JesNic Standards
## 1 - Coding
### 1.1 - Naming
File and variable names are written in camelCase style, meaning words directly follow eachother, starting with a capial letter. The name ought to be appropriate and should describe it's purpose. Abbreviations for small scopes such as for-loops are tolerated.
### 1.2 - Commenting
Code may be commented for better understanding, but it is not required.

## 2 - API
### 2.1 Interface
Interface URI: JesNic/api/interface.php

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
