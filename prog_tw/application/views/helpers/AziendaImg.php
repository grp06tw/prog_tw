<?php
class Zend_View_Helper_AziendaImg extends Zend_View_Helper_HtmlElement
{
	//prende l'immagine richiesta, se la promozione non ne ha, mette quella di default
	public function aziendaImg($imgFile)
	{
		if (empty($imgFile)) {
			$imgFile = 'default.jpg';
		}
                
		$tag = '<img class="img_elem" src="' . $this->view->baseUrl('img/aziende/' . $imgFile) . '">';
		return $tag;
	}
}