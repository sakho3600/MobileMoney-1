#include<SoftwareSerial.h>
SoftwareSerial UC20(11,12);
char numero_cell[]="5531923325";//meter numero de telefono
boolean valor=true;
int i=0;
int j=0;
char DAT;
char DAT_dos;
boolean condicion=true;
char datosSERIAL[10];

void setup()
{
  Serial.begin(9600);
  UC20.begin(9600);
  delay(2000);
  configuracion_inicial();
  delay(1000);
}

void loop()
{
 Serial.println("esperando recibir mensaje...");
while(true)
{
 void mensaje_encendido();
 delay(10000);
 
}
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
void configuracion_inicial()//configura los codigos de lectura de mensajes
{
  UC20.println("AT+IPR=9600");//modo texto
  Serial.println("AT+IPR=9600");//modo texto
  delay(300);
  UC20.println("AT+CMGF=1");//modo texto
  Serial.println("AT+CMGF=1");//modo texto
  delay(300);
  UC20.println("AT+CMGR=?");//ACTIVAMOS CODIGO PARA RECIBIR MENSAJES
  Serial.println("AT+CMGR=?");//ACTIVAMOS CODIGO PARA RECIBIR MENSAJES
  delay(300);
  UC20.println("AT+CNMI=2,2,0,0");//ACTIVAMOS PARA VER MENSAJES
  Serial.println("AT+CNMI=2,2,0,0");//ACTIVAMOS PARA VER MENSAJES
  delay(300);
  Serial.println("configuracion terminada");
  delay(300);
}

void leer_sms(){

UC20.println("AT+CMGF=1");
UC20.println("AT+CMGR=?");
UC20.println("AT+CNNI=2,2,0,0");
if (UC20.available()){
    Serial.write(UC20.read());
  }
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////ENVIO DE MENSAJES
void mensaje_encendido()
    {
      UC20.println("AT+CMGF=1");//modo texto 
      //Imprime los datos al puerto serie como texto ASCII seguido de un retorno de carro
      delay(2000);
      UC20.print("AT+CMGS=");// comando de envio de mensaje 
      //Imprime los datos al puerto serie como texto ASCII
      UC20.print((char)34);//ponemos las comillas ", para que lo tome debe ser char de lo contrario el serial envia caracter por caracter
      UC20.print(numero_cell);//colocamos numero de telefono
      UC20.println((char)34);//volvemos a poner el caracter "
      delay(200);//tiempo para que de respuesta el modulo >
      UC20.print("led uno activo ONN");//mensaje que enviare
      UC20.print((char)26);//ponemos el simbolo ascii 26,que corresponde a CTRL+Z,con lo que el modulo sabe que el sms termino
      
      Serial.println("led uno activo ONN");//mensaje que enviare
      Serial.println("Holi");//mensaje que enviare
    }
