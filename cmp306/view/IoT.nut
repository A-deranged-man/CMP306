// AGENT Code
// Function for LED Switch
function requestHandler(request, response) {
    local state = request.query["state"].tointeger();
    local pin = request.query["pin"].tointeger();
    if (pin==5) {
        device.send("ch5", state);
        response.send(200, "Recieved");
    }
    if (pin==7) {
        device.send("ch7", state);
        response.send(200, "Recieved");
    }
}
http.onrequest(requestHandler);

// Function to send data to website
const url = "https://mayar.abertay.ac.uk/~1901368/cmp306/controller/IoTdata.php";
function log(pindata) {
    local headers = {"Content-Type":"application/json"};
    local jsonpindata = http.jsonencode(pindata);

    local request = http.post(url, headers, jsonpindata);
    local response = request.sendsync();
    server.log(response.statuscode + ": " + response.body);
}
device.on("ch1", log);

// DEVICE Code
// Configure pins for lights
pin5 <- hardware.pin5;
pin5.configure(DIGITAL_OUT);
pin7 <- hardware.pin7;
pin7.configure(DIGITAL_OUT);

// Update red light state
function updateLed5(state) {
    pin5.write(state);
    sendData();
}

// Update green light state
function updateLed7(state) {
    pin7.write(state);
    sendData();
}

// Send pin info to agent
agent.on("ch5", updateLed5);
agent.on("ch7", updateLed7);


// Configure pins for temp
temp8<-hardware.pin8;
temp9<-hardware.pin9;
temp8.configure(ANALOG_IN);
temp9.configure(ANALOG_IN);

// Set variables here to make global
val8<-0;
val9<-0;

const aconst = 65535.0;
const bconst = 3988;
const t0const = 298.15;
vconst <- hardware.voltage();

function convertTempC(raw) {
    local v1 = raw * vconst / aconst;
    local r1 = 10000.0 / ((vconst / v1) -1);
    local ln1 = math.log(10000.0 / r1);
    local temp = (t0const * bconst) / (bconst - t0const * ln1);
    temp = temp -273.15;
    temp = format("%.01f", temp);
    return temp;
}

function getTemp() {
    local volt8 = temp8.read();
    local volt9 = temp9.read();
    val8 = convertTempC(volt8);
    val9 = convertTempC(volt9);
}


// Function to send light state and temp reading to agent
function sendData() {
    getTemp();
    local state5 = pin5.read();
    local state7 = pin7.read();
    local pindata = [{"pin5" : state5}, {"pin7" : state7}, {"pin8" : val8}, {"pin9" : val9}];
    server.log("Pin Data");
    server.log("Pin 5"+" "+pindata[0].pin5);
    server.log("Pin 7"+" "+pindata[1].pin7);
    server.log("Pin 8"+" "+pindata[2].pin8);
    server.log("Pin 9"+" "+pindata[3].pin9);
    agent.send("ch1", pindata);
    imp.wakeup(20, sendData);
}

sendData();