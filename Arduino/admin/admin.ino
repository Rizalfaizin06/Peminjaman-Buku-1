#include <SPI.h>
#include <MFRC522.h>
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <Wire.h>
#include <LiquidCrystal_I2C.h>

LiquidCrystal_I2C lcd (0x27, 16, 2);
//D4() - SDA
//D5() - SCK
//D7() - MOSI
//D6() - MISO
//NULL - IRQ
//GND - GND
//D3()- RST
//3V - 3.3V

#define RST_PIN         0          // Configurable, see typical pin layout above
#define SS_PIN          2
MFRC522 mfrc522(SS_PIN, RST_PIN);   // Create MFRC522 instance.

const int btn = 16;
int button;

bool quit = 0;
String iData1 = "1";
String iData2 = "2";
String iData3 = "3";
String iData4 = "36";

float temp;
String stats = "";
String sendMode = "tambahBuku";
String postData;
String Data1;
String Data2;
String Data3;
String Data4;
//String host = "192.168.43.160";
//String host = "testingstarproject.000webhostapp.com";
String host = "wirapustaka.ninapst.com";
const char* ssid = "LIMITEeD";
const char* password = "12344321";

//String url = "http://" + host + "/Krenova/GitFolder/Peminjaman-Buku-1/PHP/admin/fungsiAdmin.php";
//String url = "https://" + host + "/index.php";
String url = "http://" + host + "/admin/fungsiAdmin.php";
String dataUpload[10];


void setup() {
  Serial.begin(115200);
  pinMode(btn, INPUT);
  lcd.init();
  lcd.backlight();
  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, password);
  Serial.print("Connecting to Wi-Fi");
  while (WiFi.status() != WL_CONNECTED) {
    lcd.setCursor (2,0);
    lcd.print("Connecting  ");
    delay(250);
    lcd.setCursor (2,0);
    lcd.print("Connecting. ");
    delay(250);
    lcd.setCursor (2,0);
    lcd.print("Connecting..");
    Serial.print(".");
    delay(250);
  }
  
  Serial.println("Connected to Network/SSID");
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());
  SPI.begin(); // Init SPI bus
  mfrc522.PCD_Init(); // Init MFRC522
  lcd.clear();
  lcd.setCursor (3,0);
  lcd.print("Connected");
  delay(500);
  lcd.clear();
  
  
}

void loop() {
  lcd.setCursor (1,0);
  lcd.print("DEKATKAN BUKU");
  lcd.setCursor (0,1);
  lcd.print("UNTUK  MENAMBAH");
  
  button = digitalRead(btn);
  Serial.println(button);
  delay(50);
  if ( button == 1 ) {
    lcd.clear();
    lcd.setCursor (0,0);
    lcd.print("DEKATKAN  KARTU");
    lcd.setCursor (0,1);
    lcd.print("UNTUK  MENAMBAH");
    sendMode = "tambahAnggota";
    tambahAnggota();
    sendMode = "tambahBuku";
  }
  if ( ! mfrc522.PICC_IsNewCardPresent()) 
  {
    return;
  }
  
  if ( ! mfrc522.PICC_ReadCardSerial()) 
  {
    return;
  }
  if (quit == 1 ) {
    quit = 0;
    return;
  }
  buzer1();
  tambahBuku();
  
}

String scann() {
  while ( ! mfrc522.PICC_IsNewCardPresent()) 
  {
    delay(50);
  }
  while ( ! mfrc522.PICC_ReadCardSerial()) 
  {
    delay(50);
  }
  buzer1();
//  Serial.print("UID :");
  String guid;
  String content= "";
  byte letter;
  
  for (byte i = 0; i < mfrc522.uid.size; i++) 
  {
//     Serial.print(mfrc522.uid.uidByte[i] < 0x10 ? " 0" : " ");
//     Serial.print(mfrc522.uid.uidByte[i], HEX);
     content.concat(String(mfrc522.uid.uidByte[i] < 0x10 ? " 0" : " "));
     content.concat(String(mfrc522.uid.uidByte[i], HEX));
  }
  
  Serial.println();
  content.toUpperCase();
  guid = content.substring(1);
  guid.replace(" ", "");
  return guid;
}

void uploadDB(String satu, String dua, String tiga, String empat) {
  HTTPClient http;
  Data1 = String(satu);
  Data2 = String(dua);
  Data3 = String(tiga);
  Data4 = String(empat);
 
  postData = "Data1=" + Data1 + "&Data2=" + Data2 + "&Data3=" + Data3 + "&sendMode=" + Data4 ;
  Serial.println(postData);
 
  http.begin(url);
  Serial.println(url);
  
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");
  lcd.clear();
  lcd.setCursor (1,0);
  lcd.print("MENGIRIM DATA");
  int httpCode = http.POST(postData);
  Serial.print("uploading");
  int c = 0;
  while (httpCode != 200){
            c++;
            if (c == 3 ) {
              WiFi.disconnect();
              WiFi.begin(ssid, password);
              Serial.print("Connecting to Wi-Fi");
              int d = 0;
              lcd.clear();
              while (WiFi.status() != WL_CONNECTED) {
              d++;
              lcd.setCursor (1,0);
              lcd.print("TUNGGU SESAAT");
              lcd.setCursor (5,1);
              lcd.print("      ");
              delay(100);
              lcd.setCursor (5,1);
              lcd.print(".     ");
              delay(100);
              lcd.setCursor (5,1);
              lcd.print("..    ");
              delay(100);
              lcd.setCursor (5,1);
              lcd.print("...   ");
              delay(100);
              lcd.setCursor (5,1);
              lcd.print(".... ");
              delay(100);
              lcd.setCursor (5,1);
              lcd.print("..... ");
              delay(100);
              lcd.setCursor (5,1);
              lcd.print("......");
              delay(250);
              if (d == 18) {
                Serial.println("Reset..");
                ESP.restart();
              }
            }
            }
            if (c == 10 ) {
              http.begin(url);
              Serial.println(url);
              http.addHeader("Content-Type", "application/x-www-form-urlencoded");
              httpCode = http.POST(postData);
            }
            if (c == 25 ) {
              Serial.println("Reset..");
              ESP.restart();
            }
            
            Serial.print(".");
            Serial.println(httpCode);
            httpCode = http.POST(postData);
          }
  String payload = http.getString();


//  String namaAnggota = payload;
//  int namaAnggotaStart = namaAnggota.indexOf("nama:")+5;
//  Serial.println(namaAnggotaStart);
//  int namaAnggotaEnd = namaAnggotaStart + namaAnggota.substring(namaAnggotaStart).indexOf("|");
//  Serial.println(namaAnggotaEnd);
//  namaAnggota = namaAnggota.substring(namaAnggotaStart,namaAnggotaEnd);
//  Serial.println(namaAnggota);
//
//  String statusKirim = payload;
//  int statusKirimStart = statusKirim.indexOf("status:")+7;
//  Serial.println(statusKirimStart);
//  int statusKirimEnd = statusKirimStart + statusKirim.substring(statusKirimStart).indexOf("|");
//  Serial.println(statusKirimEnd);
//  statusKirim = statusKirim.substring(statusKirimStart,statusKirimEnd);
//  Serial.println(statusKirim);

  
  Serial.println(httpCode);
  Serial.println(payload);
  
  String statusKirim = ambilData(payload, "status");
  
  if (Data4 == "tambahBuku") {
    lcd.clear();
    lcd.setCursor (2,0);
    lcd.print("TAMBAH BUKU");

  }
  else if (Data4 == "tambahAnggota") {
    lcd.clear();
    lcd.setCursor (0,0);
    lcd.print("TAMBAH ANGGOTA");

  }
  if (statusKirim == "BERHASIL") {
    lcd.setCursor (4,1);
    lcd.print("BERHASIL");
  } else {
    lcd.setCursor (5,1);
    lcd.print("GAGAL");
  }
  http.end();
  delay(1000);
  
  lcd.clear();
  
}

void tambahBuku() {
  buzer1();
  dataUpload[0] = scann();
  Serial.print(dataUpload[0]);
  delay(700);
  uploadDB(dataUpload[0], iData2, iData4, sendMode);
 
}

void tambahAnggota() {
  buzer1();
  dataUpload[0] = scann();
  Serial.print(dataUpload[0]);
  delay(700);
  uploadDB(dataUpload[0], iData2, iData4, sendMode);
 
}

void buzer1() {
}

String ambilData(String dataPayload, String varr) {
  String responseData = dataPayload;
  int responseDataStart = responseData.indexOf(String(varr)+":")+ varr.length() + 1;
//  Serial.println(responseDataStart);
  int responseDataEnd = responseDataStart + responseData.substring(responseDataStart).indexOf("|");
//  Serial.println(responseDataEnd);
  responseData = responseData.substring(responseDataStart,responseDataEnd);
//  Serial.println(responseData);
  return responseData;
}
