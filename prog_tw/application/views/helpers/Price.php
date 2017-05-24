<?php
class Zend_View_Helper_price extends Zend_View_Helper_Abstract
{
	public function Price($promo)
	{
		$currency = new Zend_Currency();
		$formatted = '<p class="price">' . $currency->toCurrency($promo->getPrice($promo->sconto)) . '</p>';
			$formatted .= '<p class="discount"> <del>'
			             . $promo->prezzo
			             . '</del><br>Sconto ' . $promo->sconto . '%</p>';
		return $formatted;
	}
}
