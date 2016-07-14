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

class Warning {

	private $data = [];

	public function __construct(array $data){
		$this->data = $data;
	}

	public function getRegion(){
		return $this->data["regionName"];
	}

	public function getDescription(){
		return $this->data["description"];
	}

	public function getStartTime(){
		return (int)$this->data["start"] / 1000;
	}

	public function getEndTime(){
		return (int)$this->data["end"] / 1000;
	}

	public function getEvent(){
		return $this->data["event"];
	}

	public function getHeadline(){
		return $this->data["headline"];
	}

	public function getInstruction(){
		return $this->data["instruction"];
	}

	public function getState(){
		return [$this->data["state"], $this->data["stateShort"]];
	}

	public function getAltitudeStart(){
		return $this->data["altitudeStart"];
	}

	public function getAltitudeEnd(){
		return $this->data["altitudeEnd"];
	}

	public function getType(){
		return $this->data["type"];
	}

	public function getLevel(){
		return $this->data["level"];
	}

}