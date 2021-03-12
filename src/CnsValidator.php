<?php
/**
 * CnsValidator class file.
 *
 * @author    George T Lopes <devgeo@gmail.com>
 * @copyright 2021 - Polícia Militar do Estado do Amazonas
 * @license   https://opensource.org/licenses/BSD-3-Clause - BSD-3-Clause
 */

namespace Dtipmam\YiiValidator;

use Yii;
use CValidator;

/**
 * CPFValidator validates CNS number.
 *
 * @author  George T Lopes <devgeo@gmail.com>
 * @version 0.1
 */
class CnsValidator extends CValidator {

    var $allowEmpty = true;
    private $_TAMANHO_CNS = 15;
    private $_NUMEROS_CNS = 14;

    /**
     * Validates the attribute.
     * If there is any error, the error message is added to the object.
     *
     * @param CModel the data object being validated
     * @param string the name of the attribute to be validated.
     */
    protected function validateAttribute($object, $attribute)
    {
        $value = $object->$attribute;
        if ($this->allowEmpty && $this->isEmpty($value)) {
            return;
        }

        if (!$this->validateCns($value)) {
            $this->addError($object, $attribute, Yii::t('yii', '{attribute} não é válido.'));
        }
    }

    /**
     * Validates CNS.
     * If there is any error, the error message is added to the object.
     *
     * @param string the CNS 15 digits number.
     * @return string the comparison between given and the expected value.
     */
    private function validateCns($cns)
    {

        $numero = substr($cns, strlen($cns) - $this->_TAMANHO_CNS, $this->_NUMEROS_CNS);
        $pesosDigito = [15, 14, 13, 12, 11, 10, 9, 8, 7, 6, 5, 4, 3, 2, 1];
        $modulo = 11;

        $soma = 0;
        for ($i=0; $i < strlen($numero); $i++) {
            $soma += ((int) substr($numero, $i, 1)) * $pesosDigito[$i];
        }

        $resto = $soma % $modulo;
        $resultado = $modulo - $resto;
        $digitoCalculado = ($resultado !== 11) ? $resultado : 0;
        $digito = '000' + $digitoCalculado;

        if ($resultado === 10) {
            $soma += 2;
            $digitoCalculado = $modulo - ($soma % $modulo);
            $digito = '001' + $digitoCalculado;
        }

        return $cns === $numero . $digito;
    }

}
