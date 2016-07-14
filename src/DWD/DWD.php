<?php

/*
 * MIT License
 *
 * Copyright (c) 2016 Niklas Kreer
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace DWD;

class DWD {

	const EXPIRE_TIME = 600; //10 minutes, as suggested by DWD
	
	/**
	* @var Warning[]
	*/
	private static $warnings = [];

	/**
	 * @var int
	 */
	private static $lastUpdate = 0;

    /**
     * @param $search
     * @return Warning[]
     */
	public static function getWarning($search){
		$result = [];
		foreach(self::$warnings as $warning){
			if(stripos($warning->getRegion(), $search) !== false ||
			   stripos($warning->getState()[1], $search) !== false){
				$result[] = $warning;
			}
		}
		return $result;
	}

    /**
     * @return bool
     */
	public static function update(){
		$data = file_get_contents("http://www.dwd.de//DWD/warnungen/warnapp/json/warnings.json");
        if($data){
            self::$lastUpdate = time();
            $data = str_ireplace(["warnWetter.loadWarnings(", ");"], ["", ""], $data); //Convert JSONP to JSON
            $data = json_decode($data, true); //Convert result into array
            self::$warnings = []; //Reset the array
            $arrays = ["warnings", "vorabInformation"]; //Get warnings and vorabInformation
            foreach($arrays as $array){
                foreach($data[$array] as $warnings){
                    self::addWarnings($warnings); //Add multiple warnings
                }
            }
            return true;
        }
        return false;
	}

    /**
     * @param array $warnings
     */
    private static function addWarnings(array $warnings){
        foreach($warnings as $warning){
            self::$warnings[] = new Warning($warning); //Create new Warning object
        }
    }

    /**
     * @return bool
     */
    public static function isValid(){
        if(time() <= self::$lastUpdate + self::EXPIRE_TIME){
            return true;
        }
        return false;
    }

    /**
     * @return Warning[]
     */
    public static function getWarnings(){
        return self::$warnings;
    }

    /**
     * @return string
     */
    public static function getGermanyMap(){
        return "http://www.dwd.de/DWD/warnungen/warnapp_gemeinden/json/warnungen_gemeinde_map_de.png";
    }

}