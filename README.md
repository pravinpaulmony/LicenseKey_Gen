#KEY GENERATION

#User Inputs -  Email Id					System Inputs -  User Id, Product Id

Get User email id from user input and user id, product Id from database or a configuration file
Clean user email id by removing special characters and empty spaces
Validate email format and return response.
If email is valid define license key generator function
Encode the user email, user id and product Id using md5 encryption.
Parse the string and convert into a standard license key format
Return the new license key

#Observations & Notes:

The information needs to be stored in a database when a new license key is generated.
The necessary informations are user email, user id, product id, key generated date and key expiry date.
Before inserting the record we have to check whether a record for the same user with the same product key already exists.
If it exists,  a new license key should not be generated but it should display a message that the key for the account exists.
And if the key is expired it should display a message that the license key has expired.

#KEY VALIDATION

#User Inputs -  Email Id, LIcense Key				System Inputs -  User Id, Product Id

Get User email id and license key from user input and user id, product Id from database or a configuration file
Clean user email id by removing special characters and empty spaces
Validate email format and return response.
Validate the license key standard format and return response.
If email format and license key format is valid define the license validator function
Generate the license key based on the user email, user id and product Id
Check whether the generated key matches with the user license key from the user input.
If matches return a success message or return failure. 

#Observations & Notes:

For license key validation the first step is to validate that the generated key matches with the user license key from user input. 
If matched the next validation must be the key expiry date validation whether the license key is active or not.
