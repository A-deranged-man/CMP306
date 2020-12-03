// AGENT Code
// define the http handler
function requestHandler(request, response) {
    local state = request.query["state"].tointeger() ;
    local pin = request.query["pin"].tointeger() ;

    if (pin == 5){
    device.send("ch5", state);
    response.send(200, "OK");
    }

    if (pin == 7){
    device.send("ch7", state);
    response.send(200, "OK");
    }

}
// register the http handler
http.onrequest(requestHandler)


//  Device Code
// define and configure the pins
local pin5 = hardware.pin5 ;
pin5.configure(DIGITAL_OUT);
local pin7 = hardware.pin7 ;
pin7.configure(DIGITAL_OUT);
// function to turn LED on pin 5 on or off
function updateLed5(state) {
    pin5.write(state) ;
    server.log(" Pin 5 - State : " + state);
}

function updateLed7(state) {
    pin7.write(state) ;
    server.log(" Pin 7 - State : " + state);
}
// register a handler for "led" messages from the agent
agent.on("ch5", updateLed5);
agent.on("ch7", updateLed7);