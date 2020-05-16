# WIMEA-ICT_AWS_Monitor
 WIMEA-ICT Automatic Weather Station Monitor. Used to monitor the status of Automatic Weather Stations to establish if there are faults associated with the AWS. Below are the modules that run in the background
 1) listener - Listens on a predetermined port number, receiving incoming packets and storing them in files associated with the AWS and database
 2) analyzer - processes database records to establish if there is a fault with the AWSs. uses SPRED algorithm explained under https://eudl.eu/doi/10.4108/eai.20-12-2018.156083 
 3) Outlier - runs through the database and estabishes if there are any outliers
