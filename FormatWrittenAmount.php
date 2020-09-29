<?php

class FormatWrittenAmount
{
   
   public function format($value,$n){
      $str = '';
      $n = $n-strlen($value);
      for($i=0;$i<$n;$i++){
         $str .='0';
      }
      $str .= $value;
      return $str;
   }

   public function unit($value){
      $num = "";
      switch ($value){
         case 9: $num = "NUEVE"; break;
         case 8: $num = "OCHO"; break;
         case 7: $num = "SIETE"; break;
         case 6: $num = "SEIS"; break;
         case 5: $num = "CINCO"; break;
         case 4: $num = "CUATRO"; break;
         case 3: $num = "TRES"; break;
         case 2: $num = "DOS"; break;
         case 1: $num = "UN"; break;
      }
      return $num;
   }

   /**
    * @param $value
    * @return string
    */
   public function ten($value) 
   {
      $numberTen = "";
      if ($value >= 90 && $value <= 99) {
         $numberTen = "NOVENTA ";
         if ($value > 90) $numberTen = $numberTen."Y ".($this->unit($value - 90));
      }
      elseif ($value >= 80 && $value <= 89) {
         $numberTen = "OCHENTA ";
         if ($value > 80) $numberTen = $numberTen."Y ".($this->unit($value - 80));
      }
      elseif ($value >= 70 && $value <= 79) {
         $numberTen = "SETENTA ";
         if ($value > 70) $numberTen = $numberTen."Y ".($this->unit($value - 70));
      }
      elseif ($value >= 60 && $value <= 69) {
         $numberTen = "SESENTA ";
         if ($value > 60) $numberTen = $numberTen."Y ".($this->unit($value - 60));
      }
      elseif ($value >= 50 && $value <= 59) {
         $numberTen = "CINCUENTA ";
         if ($value > 50) $numberTen = $numberTen."Y ".($this->unit($value - 50));
      }
      elseif ($value >= 40 && $value <= 49) {
         $numberTen = "CUARENTA ";
         if ($value > 40) $numberTen = $numberTen."Y ".($this->unit($value - 40));
      }
      elseif ($value >= 30 && $value <= 39) {
         $numberTen = "TREINTA ";
         if ($value > 30) $numberTen = $numberTen."Y ".($this->unit($value - 30));
      }
      elseif ($value >= 20 && $value <= 29) {
         if ($value == 20)
            $numberTen = "VEINTE ";
         else
            $numberTen = "VEINTI".($this->unit($value - 20));
      } elseif ($value >= 10 && $value <= 19) {
         switch ($value) {
            case 10: $numberTen = "DIEZ "; break;
            case 11: $numberTen = "ONCE "; break;
            case 12: $numberTen = "DOCE "; break;
            case 13: $numberTen = "TRECE "; break;
            case 14: $numberTen = "CATORCE "; break;
            case 15: $numberTen = "QUINCE "; break;
            case 16: $numberTen = "DIECISEIS "; break;
            case 17: $numberTen = "DIECISIETE "; break;
            case 18: $numberTen = "DIECIOCHO "; break;
            case 19: $numberTen = "DIECINUEVE "; break;
         }
      }
      else {
         $numberTen = $this->unit($value);
      }
      return $numberTen;
   }

   /**
    * @param $value
    * @return string
    */

   public function hundred($value) 
   {
      $numberH="";
      if ($value >= 100) {
         if ($value >= 900 && $value <= 999) {
            $numberH = "NOVECIENTOS ";
            if ($value > 900) $numberH = $numberH.($this->ten($value - 900));
         } elseif ($value >= 800 && $value <= 899) {
            $numberH = "OCHOCIENTOS ";
            if ($value > 800) $numberH = $numberH.($this->ten($value - 800));
         } elseif ($value >= 700 && $value <= 799) {
            $numberH = "SETECIENTOS ";
            if ($value > 700) $numberH = $numberH.($this->ten($value - 700));
         } elseif ($value >= 600 && $value <= 699) {
            $numberH = "SEISCIENTOS ";
            if ($value > 600) $numberH = $numberH.($this->ten($value - 600));
         } elseif ($value >= 500 && $value <= 599) {
            $numberH = "QUINIENTOS ";
            if ($value > 500) $numberH = $numberH.($this->ten($value - 500));
         } elseif ($value >= 400 && $value <= 499) {
            $numberH = "CUATROCIENTOS ";
            if ($value > 400) $numberH = $numberH.($this->ten($value - 400));
         } elseif ($value >= 300 && $value <= 399) {
            $numberH = "TRESCIENTOS ";
            if ($value > 300) $numberH = $numberH.($this->ten($value - 300));
         } elseif ($value >= 200 && $value <= 299) {
            $numberH = "DOSCIENTOS ";
            if ($value > 200) $numberH = $numberH.($this->ten($value - 200));
         } elseif ($value >= 100 && $value <= 199) {
            if ($value == 100)
               $numberH = "CIEN ";
            else
               $numberH = "CIENTO ".($this->ten($value - 100));
         }
      } else {
         $numberH = $this->ten($value);
      }
      return $numberH;
   }

   /**
    * @param $value
    * @return string
    */
   public function thousands($value) 
   {
      $numTh = ""; 
      if ($value >= 1000 && $value < 2000) {
         $numTh = "MIL ".($this->hundred($value%1000));
      } elseif ($value >= 2000 && $value <10000) {
         $numTh = $this->unit(Floor($value/1000))." MIL ".($this->hundred($value%1000));
      } elseif ($value < 1000) {
         $numTh = $this->hundred($value);
      }
      return $numTh;
   }

   /**
    * @param $value
    * @return string
    */
   public function tenThousands($value) 
   {
      $numdTenTh = "";
      if ($value == 10000) {
         $numdTenTh = "DIEZ MIL";
      } elseif ($value > 10000 && $value <20000) {
         $numdTenTh = $this->ten(Floor($value/1000))."MIL ".($this->hundred($value%1000));
      } elseif ($value >= 20000 && $value <100000) {
         $numdTenTh = $this->ten(Floor($value/1000))." MIL ".($this->thousands($value%1000));
      } elseif ($value < 10000) {
         $numdTenTh = $this->thousands($value);
      }
      return $numdTenTh;
   }

   /**
    * @param $value
    * @return string
    */
   public function hundredThousands($value) 
   {
      $numHt="";
      if ($value == 100000) {
         $numHt = "CIEN MIL";
      } elseif ($value >= 100000 && $value <1000000) {
         $numHt = $this->hundred(Floor($value/1000))." MIL ".($this->hundred($value%1000));
      } elseif ($value < 100000) {
         $numHt = $this->tenThousands($value);
      }
      return $numHt;
   }

   /**
    * @param $value
    * @return string
    */
   public function million($value) 
   {
      $numM="";
      if ($value >= 1000000 && $value <2000000) {
         $numM = "UN MILLON ".($this->hundredThousands($value%1000000));
      } elseif ($value >= 2000000 && $value <10000000) {
         $numM = $this->unit(Floor($value/1000000))." MILLONES ".($this->hundredThousands($value%1000000));
      } elseif ($value < 1000000) {
         $numM = $this->hundredThousands($value);
      }
      return $numM;
   }

   /**
    * @param $value
    * @return string
    */
   public function tenMillion($value) 
   {
      $numTm = "";
      if ($value == 10000000) {
         $numTm = "DIEZ MILLONES";
      } elseif ($value > 10000000 && $value <20000000) {
         $numTm = $this->ten(Floor($value/1000000))."MILLONES ".($this->hundredThousands($value%1000000));
      } elseif ($value >= 20000000 && $value <100000000) {
         $numTm = $this->ten(Floor($value/1000000))." MILLONES ".($this->million($value%1000000));
      } elseif ($value < 10000000) {
         $numTm = $this->million($value);
      }
      return $numTm;
   }

   /**
    * @param $value
    * @return string
    */
   function hundredMillion($value) 
   {
      $numHm="";
      if ($value == 100000000) {
         $numHm = "CIEN MILLONES";
      } elseif ($value >= 100000000 && $value <1000000000) {
         $numHm = $this->hundred(Floor($value/1000000))." MILLONES ".($this->million($value%1000000));
      } elseif ($value < 100000000) {
         $numHm = $this->tenMillion($value);
      }
      return $numHm;
   }

   /**
    * @param $value
    * @return string
    */
   public function thousandsMillion($value) 
   {
      $numMd=""; // Valor a Devolver
      if ($value >= 1000000000 && $value <2000000000) {
         $numMd = "MIL ".($this->hundredMillion($value%1000000000));
      } elseif ($value >= 2000000000 && $value <10000000000) {
         $numMd = $this->unit(Floor($value/1000000000))." MIL ".($this->hundredMillion($value%1000000000));
      } elseif ($value < 1000000000) {
         $numMd = $this->hundredMillion($value);
      }
      return $numMd;
   }

   /**
    * @param $value
    * @param $decimal
    * @param bool $cent
    * @return string
    */
   public static function convert($value,$decimal=".",$cent=false)
   {

      $format = new FormatWrittenAmount();
      $value = number_format(abs($value),2,$decimal,"");

      $partes = explode($decimal,$value);

      if(!$cent) {

         $val=$format->thousandsMillion($partes[0]);

      } else { // require 00/100


         $val=$format->thousandsMillion(abs($partes[0]))." CON ".((count($partes)==1)?" 00/100":($format->format($partes[1],2)."/100"));

      }
      return $val;
   }
}



