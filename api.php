<?php
/* Php Eobot Api sistem
 * version: 0.0.1
 **/

 namespace TraderSistem;

 class EobotApi
 {

   private $EobotUserID;
   private $EobotEmail;
   private $EbotApiKey;
   private $EbotPassword;

   private $urlApi = "https://www.eobot.com/api.aspx?" ;
   private $format = "&json=true";

   /*
   * __construct
   * $userID string the your user id
   * $userEmail string the your email
   * $UserPassword string the your Password or the Api Key
   *
   **/
   function __construct( string $userID = "", string $userEmail = "", string $UserPassword = "")
   {
     //confing
     $this->EobotUserID = $userID;
     $this->EobotEmail = $userEmail;
     $this->EbotPassword = $UserPassword;
     //confing
   }

   /*
   * Private Function akeRequest
   * call the endpoint of eobotapi with file_get_contents and id set callback function pass the response to callback function.
   * (string) $url of endipoin
   * $callback user_function.
   *
   * return $response
   **/
   private function MakeRequest( string $url, $callback = "")
   {
     $response = json_decode(
       file_get_contents($url),
       true
     );

     //if(!$response) throw new \Exception('Error! the response is empty please check the parameters or try again in a few moments');

     if(!empty($callback)){
       $response = call_user_func($callback, $response);
     }

     return $response;
   }

   /*
   * getBalances()
   * call the ...?total=$ID&json=true to get the your balance.
   * (string) [optional] $Id your id
   * $callback user_function.
   *
   * return array or calback works
   **/
   public function getBalances($Id = "", $callback = "")
   {
     $ID = ( empty($Id) ) ? $this->EobotUserID : $Id;

     return $this->MakeRequest(
       "{$this->urlApi}total={$ID}{$this->format}",
       $callback
     );
   }

   /*
   * getMiningMode()
   * call the ...?idmining=$ID&json=true to get the your balance.
   * (string) [optional] $Id your id
   * $callback user_function.
   *
   * return array or calback works
   **/
   public function getMiningMode($Id = "", $callback = "")
   {
     $ID = ( empty($Id) ) ? $this->EobotUserID : $Id;

     return $this->MakeRequest(
       "{$this->urlApi}idmining={$ID}{$this->format}",
       $callback
     );
   }

   /*
   * getSpeed()
   * call the ...?idspeed=$ID&json=true to get the your balance.
   * (string) [optional] $Id your id
   * $callback user_function.
   *
   * return array or calback works
   **/
   public function getSpeed($Id = "", $callback = "")
   {
     $ID = ( empty($Id) ) ? $this->EobotUserID : $Id;

     return $this->MakeRequest(
       "{$this->urlApi}idspeed={$ID}{$this->format}",
       $callback
     );
   }

   /*
   * getSpeed()
   * call the ...?id={ID}&deposit={COIN}&json=true to get the your balance.
   * (string) [optional] $Id your id
   * (string) $depositType coin coide [default BTC]
   * $callback user_function.
   *
   * return array or calback works
   **/
   public function getDepositAddress($Id = "", $depositType = "BTC", $callback = "")
   {
     $ID = ( empty($Id) ) ? $this->EobotUserID : $Id;

     return $this->MakeRequest(
       "{$this->urlApi}id={$ID}&deposit={$depositType}{$this->format}",
       $callback
     );
   }

   /*
   * getSpeed()
   * call the ...?email={EMAIL}&password={PASSWORD|APIKEY}&json=true to get the your balance.
   * (string) [optional] $email your id
   * (string) [optional] $password
   * $callback user_function.
   *
   * return array or calback works
   **/
  public function getUserID($email = "", $password = "", $callback = "")
  {
    $email = ( empty($email) ) ? $this->EobotEmail : $email;
    $psw = ( empty($password) ) ? $this->EbotPassword : $password;

    return $this->MakeRequest(
      "{$this->urlApi}email={$email}&password={$psw}{$this->format}",
      $callback
    );
  }

  /*
  * setMiningMode()
  * call the ...?id={$ID}&email={$email}&password={$password|apikey}&mining={$miningMode}&json=true to get the your balance.
  * (string) [optional] $id your id
  * (string) [optional] $email your email
  * (string) [optional] $password your password|apikey
  * (string) $miningMode Coin Code
  * $callback user_function.
  *
  * return empty array
  **/
  public function setMiningMode(string $Id = "", string $email = "", string $password = "", string $miningMode = "DOGE", $callback = "")
  {
    $ID = ( empty($Id) ) ? $this->EobotUserID : $Id;
    $email = ( empty($email) ) ? $this->EobotEmail : $email;
    $psw = ( empty($password) ) ? $this->EbotApiKey : $password;

    return $this->MakeRequest(
      "{$this->urlApi}id={$ID}&email={$email}&password={$psw}&mining={$miningMode}{$this->format}",
      $callback
    );
  }

  /*
  * setAutomaticWithdraw()
  * call the ...?id={$ID}&email={$email}&password={$password|apikey}&withdraw={$currency}&amount={$amount}&wallet={$walletAddress}&json=true to get the your balance.
  * (string) [optional] $id your id
  * (string) [optional] $email your email
  * (string) [optional] $password your password|apikey
  * (string) $currency Coin code
  * (float) $amount round(number, 8)
  * (string) $walletAddress your wallet adreass
  * $callback user_function.
  *
  * return empty array
  **/
  public function setAutomaticWithdraw($Id = "", $email = "", $password = "", $currency, float $amount, $walletAddress, $callback = "")
  {
    $ID = ( empty($Id) ) ? $this->EobotUserID : $Id;
    $email = ( empty($email) ) ? $this->EobotEmail : $email;
    $psw = ( empty($password) ) ? $this->EbotApiKey : $password;

    return $this->MakeRequest(
      "{$this->urlApi}id={$ID}&email={$email}&password={$psw}&withdraw={$currency}&amount=" .round($amount, 8) . "&wallet={$walletAddress}{$this->format}",
      $callback
    );
  }

  /*
  * manualWithdraw()
  * call the ...?id={$ID}&email={$email}&password={$password|apikey}&manualithdrawithdraw={$currency}&amount={$amount}&wallet={$walletAddress}&json=true to get the your balance.
  * (string) [optional] $id your id
  * (string) [optional] $email your email
  * (string) [optional] $password your password|apikey
  * (string)  $currency Coin code
  * (float)  $amount round(number, 8)
  * (string)  $walletAddress your wallet adreass
  * $callback user_function.
  *
  * return array
  **/
  public function manualWithdraw($Id = "", $email = "", $password = "", $currency, float $amount, $walletAddress, $callback = "")
  {
    $ID = ( empty($Id) ) ? $this->EobotUserID : $Id;
    $email = ( empty($email) ) ? $this->EobotEmail : $email;
    $psw = ( empty($password) ) ? $this->EbotApiKey : $password;

    return $this->MakeRequest(
      "{$this->urlApi}id={$ID}&email={$email}&password={$psw}&manualwithdraw={$currency}&amount=" .round($amount, 8) . "&wallet={$walletAddress}{$this->format}",
      $callback
    );
  }

  /*
  * exchangeCryptocurrency()
  * call the ...?id={$ID}&email={$email}&password={$password|apikey}&convertfrom={$currencyFrom}&amount={$amount}&wallet={$currencyTo}&json=true to get the your balance.
  * (string) [optional] $id your id
  * (string) [optional] $email your email
  * (string) [optional] $password your password|apikey
  * (string) $currencyFrom Coin code
  * (float) $amount round(number, 8)
  * (string) $currencyTo Coin code
  * $callback user_function.
  *
  * return array
  **/
  public function exchangeCryptocurrency($Id = "", $email = "", $password = "", strin $currencyFrom, float $amount, strin $currencyTo, $callback = "")
  {
    $ID = ( empty($Id) ) ? $this->EobotUserID : $Id;
    $email = ( empty($email) ) ? $this->EobotEmail : $email;
    $psw = ( empty($password) ) ? $this->EbotApiKey : $password;

    return $this->MakeRequest(
      "{$this->urlApi}id={$ID}&email={$email}&password={$psw}&convertfrom={$currencyFrom}&amount=" .round($amount, 8) . "&convertto={$currencyTo}{$this->format}",
      $callback
    );
  }

  /*
  * exchangeEstimate()
  * call the ...?exchangefee=true&convertfrom={$from}&amount={$amount}&convertto={$to}&json=true to get the your balance.
  * (string) $from Coin code
  * (float)  $amount round(number, 8)
  * (string) $to Coin code
  * $callback user_function.
  *
  * return array
  **/
  public function exchangeEstimate(string $from, float $amount, string $to, $callback = "")
  {
    return $this->MakeRequest(
      "{$this->urlApi}exchangefee=true&convertfrom={$from}&amount=" .round($amount, 8) . "&convertto={$to}{$this->format}",
      $callback
    );
  }

  /*
  * exchangeEstimate()
  * call the ...?coin{$coin}&json=true to get the your balance.
  * (string) $coin Coin code
  *
  * return array
  **/
  public function getCoinPrice(string $coin, $callback = "")
  {
    return $this->MakeRequest(
      "{$this->urlApi}coin={$coin}{$this->format}",
      $callback
    );
  }

 }
