<?php

class RomanNumeral {

  public static $numerals = [ 'M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 
                              'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1 ];

  static function toNumeral($num) {

    // 1) Only return numerals between 1 and 3999
    if(0 > $num || $num > 3999 || !is_int($num)) return false;

    $result = '';
    
    // 2) Iterate numerals starting with largest divisor, 1000
    foreach(self::$numerals as $key => $val) {
      
        // 3) While enumeration is possible given our current divisor:
        while ( $num >= $val ) {

            // 4) Append numeral to result
            $result .= $key;

            // 5) Decrement number until it is no longer divisible 
            $num -= $val;
        }

        // 6) Break for loop if we have reached a solution
        if($num === 0) break;
    }
    
    return $result;

  }

}

class RomanTest extends PHPUnit_Framework_TestCase
{
  protected function setUp() {
    $this->rn = new RomanNumeral(); 
  }

  public function testUpperLimit() {
    $this->assertEquals(false, $this->rn->toNumeral(4000));
  }

  public function testLowerLimit() {
    $this->assertEquals(false, $this->rn->toNumeral(0));
  }

  public function testNonInt() {
    $this->assertEquals(false, $this->rn->toNumeral('foo')); 
  }

  public function testNumeralI() {
    $this->assertEquals('I', $this->rn->toNumeral(1));
  }

  public function testNumeralV() {
    $this->assertEquals('V', $this->rn->toNumeral(5));
  }

  public function testNumeralX() {
    $this->assertEquals('X', $this->rn->toNumeral(10));
  }

  public function testNumeralXX() {
    $this->assertEquals('XX', $this->rn->toNumeral(20));
  }

  public function testNumeralMMMCMXCIX() {
    $this->assertEquals('MMMCMXCIX', $this->rn->toNumeral(3999));
  }
  
}
?>
