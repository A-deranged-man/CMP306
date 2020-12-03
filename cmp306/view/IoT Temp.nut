//Device Code
// Read sensor details
// Configure Pin
// thermistor connected to pin 8 / pin 9
temp8<- hardware.pin8 ;
temp9<- hardware.pin9 ;
temp8.configure(ANALOG_IN);
temp9.configure(ANALOG_IN);
//  Define the relevant constants for this thermistor
const aconst = 65535.0 ;
const bconst = 3988;
const t0const = 298.15;
vconst <- hardware.voltage() ;
function convertTempC(raw) {
    local v1 = raw * vconst / aconst ;
    local r1 = 10000.0 / ( (vconst / v1) - 1);
    local ln1 = math.log(10000.0 / r1);
    local temp = (t0const * bconst) / (bconst - t0const * ln1) ;
    temp = temp - 273.15;  // Convert Kelvin to Celcius
    temp =  format("%.01f", temp) ;
    return temp;
}
//  function to read the voltages
function getTemp() {
// read the value
    local volt8 = temp8.read() ;
    local volt9 = temp9.read() ;
    local val8 = convertTempC(volt8) ;
    local val9 = convertTempC(volt9) ;
    server.log("Reading") ;
    server.log (val8) ;
    server.log (val9) ;
// //  generate the message
    local message = [{"pin" : "8" , "value" : val8 }, {"pin" : "9" , "value" : val9 } ] ;
//  write these all out
    server.log("Message ") ;
    server.log (message[0].pin+" "+message[0].value) ;
    server.log (message[1].pin+" "+message[1].value) ;
// send the message to the agent
    agent.send("ch1", message) ;
// get the imp to sleep and wake up every 20 s
    imp.wakeup(20, getTemp);
}
getTemp() ;

// Agent code
//  define the URL of the server code
const url = "https://mayar.abertay.ac.uk/~1901368/cmp306/controller/temprature.php" ;
//  function to call the script to log the sensor values
function log(message) {
    local headers = { "Content-Type" : "application/json"} ;
    local jsonBody = http.jsonencode(message) ;
//  POST the values ;
    local request = http.post(url, headers, jsonBody);
    local response = request.sendsync();
    server.log(response.statuscode + ": " + response.body);
}
// act on the values sent
device.on("ch1", log) ;