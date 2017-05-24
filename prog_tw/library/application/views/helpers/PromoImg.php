<?php
class Zend_View_Helper_PromoImg extends Zend_View_Helper_HtmlElement
{
	//prende l'immagine richiesta, se la promozione non ne ha, mette quella di default
	public function promoImg($imgFile)
	{
		if (empty($imgFile)) {
			$imgFile = 'default.jpg';
		}
                
		$tag = '<img class="img_promo" src="' . $this->view->baseUrl('img/promo/' . $imgFile) . '">';
		return $tag;
	}
}