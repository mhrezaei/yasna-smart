/*********
  Author: Mohmammad Hadi Rezaei
  Email: hadi@yasna.team
  Website: https://rabbitfox.com
  Project: Yasna Smarty
  Description: The home smart controller with ESP8266 
*********/

#include <ESP8266WiFi.h>
#include <WiFiManager.h>

#include <ESP8266HTTPClient.h>
#include <Arduino_JSON.h>

// RGB LED pin config
int blueLed = 13;
int redLed = 15;
int greenLed = 12;

// Your server IP or Domain name address
const char* serverAddress = "SERVER ADDRESS";

// Your access token
const char* accessToken = "ACCESS TOKEN";
const char* requestName = "getClientStates";

// Update period time set to fetch data. default: 5 seconds
const long fetchPeriod = 5000;
unsigned long previousRound = 0;
String moduleState;

// Dispaly an alert with RGB LED
void ledAlert(int ledPin)
{
  digitalWrite(ledPin, HIGH);
  delay(100);
  digitalWrite(ledPin, LOW);
  delay(50);
}

void setup() {
  
  Serial.begin(115200);

  // set RGB pin mode
  pinMode(blueLed, OUTPUT);
  pinMode(redLed, OUTPUT);
  pinMode(greenLed, OUTPUT);
 
  // WiFiManager
  WiFiManager wifiManager;
  
  // Uncomment and run it once, if you want to erase all the stored information
  //wifiManager.resetSettings();
  
  // set custom ip for portal
  //wifiManager.setAPConfig(IPAddress(10,0,1,1), IPAddress(10,0,1,1), IPAddress(255,255,255,0));

  // First Setup open SSID name
  wifiManager.autoConnect("Yasna Smarting");
  
  // if you get here you have connected to the WiFi
  Serial.println("Connected.");
  
  // LED alert
  //ledAlert(blueLed);
}

void loop(){
  // fetch the new states
  fetchStates();
}

// Fetching the real states
void fetchStates(){
  unsigned long nowRunning = millis();
  
  if(nowRunning - previousRound >= fetchPeriod) {
     // Check WiFi connection status
    //if ((WiFiMulti.run() == WL_CONNECTED)) {
    if (1 == 1) {

      // fetch data from server
      moduleState = hgmr(serverAddress);

      // Parse the recieved json data from server
      JSONVar takenState = JSON.parse(moduleState);
      //takenState = takenState['node'];
  
      // Check the type of json object
      if (JSON.typeof(takenState) == "undefined") {
        
        // The recieved data not be valid
        Serial.println("The recieved data not be valid");

        // LED alert
        ledAlert(redLed);

        return;
      }
    
      Serial.println(takenState);
    
      // Find the pins number
      JSONVar pins = takenState.keys();
    
      for (int i = 0; i < pins.length(); i++) {

        // New pin state
        JSONVar value = takenState[pins[i]];
        
        // Set the Free GPIO pins
        pinMode(atoi(pins[i]), OUTPUT);

        // Write the new state to pin
        digitalWrite(atoi(pins[i]), atoi(value));

        Serial.print("GPIO: ");
        Serial.print(pins[i]);
        Serial.print(" - SET to: ");
        Serial.println(value);

      }

        // LED alert
        ledAlert(greenLed);

      // Save the last fetch data from server
      previousRound = nowRunning;
    }
    else {
      // When we have any active internet connection
      Serial.println("WiFi Disconnected");

      // LED alert
      ledAlert(redLed);
      ledAlert(blueLed);
    }
  }
}

// HTTP POST method request
String hgmr(const char* serverAddress) {
  // use the wifi client package
  WiFiClient client;

  // use the HTTP cilent package
  HTTPClient http;
    
  // Request address 
  http.begin(client, serverAddress);
  http.addHeader("Content-Type", "application/json");

  String PostData="{\"token\":\"";
    PostData=PostData+accessToken+"\",";
    PostData=PostData+"\"request\":\"";
    PostData=PostData+requestName+"\"";
    PostData=PostData+"}"; 
  
  // Respons code from server
  int responseCode = http.POST(PostData);
  
  // create the data string
  String data = "{}"; 
  
  if (responseCode == 200) {
    Serial.print("HTTP Response code: ");
    Serial.println(responseCode);
    data = http.getString();
  }
  else {
    // Bad request or respons code
    Serial.print("Error code: ");
    Serial.println(responseCode);

    // LED alert
      ledAlert(redLed);
      ledAlert(greenLed);
  }

  // Free resources one ESP8266
  http.end();

  return data;
}
