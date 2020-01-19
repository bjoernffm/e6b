<?php

namespace bjoernffm\e6b;

use \InvalidArgumentException;

abstract class DataTable
{
    /**
     * This function returns the whole dataset of data adjusted to a given field
     * and its value.
     */
    public function getDataByField($field, $value)
    {
        $record = null;

        if ($value <= $this->data[0][$field]) {
            // if the searched value is already lower than the lowest record, take the lowest record
            $record = $this->data[0];
        } else if ($value > $this->data[count($this->data)-1][$field]) {
            // if the searched value is already higher than the highest record, take the highest record
            $record = $this->data[count($this->data)-1];
        } else {
            for($i = 0; $i < count($this->data); $i++) {
                if ($this->data[$i][$field] <= $value and $value < $this->data[$i+1][$field]) {
                    $factor = $this->interpolateFactor($this->data[$i][$field], $this->data[$i+1][$field], $value);

                    if ($factor == 0) {
                        // if factor is 0, it is exactly the first record
                        $record = $this->data[$i];
                    } else {
                        foreach($this->data[$i+1] as $key => $value) {
                            $record[$key] = (($value-$this->data[$i][$key])*$factor)+$this->data[$i][$key];
                        }
                    }
                }
            }
        }

        return $record;
    }

    /**
     * Magic function for direct access to any datum.
     */
    public function __call($name, $arguments)
    {
        if (strrpos($name, 'getDataBy', -strlen($name)) !== false) {
            $field = substr ($name, 9);
            $field[0] = strtolower($field[0]);

            if (!isset($this->data[0][$field])) {
                throw new InvalidArgumentException('Field '.$field.' is not existing');
            }
            if (count($arguments) != 1) {
                throw new InvalidArgumentException('One parameter is required');
            }

            return $this->getDataByField($field, $arguments[0]);
        }
    }

    /**
     * This function calculates and returns a factor to be used in the
     * getDataByField function to calculate the values between the hardcoded
     * values.
     */
    public function interpolateFactor($lowerData, $higherData, $value)
    {
        if ($lowerData > $higherData) {
            throw new InvalidArgumentException('Parameter $lowerData needs to be smaller or equal than $higherData');
        }

        if ($value < $lowerData or $value > $higherData) {
            throw new InvalidArgumentException('Parameter $value need to be between $lowerData and $higherData');
        }

        if ($value == $lowerData and $value == $higherData) {
            return 0;
        }

        $factor = ($value-$lowerData)/($higherData-$lowerData);
        return $factor;
    }
}