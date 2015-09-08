<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<!-- This component modified and coded by Sultanayev Marat -->
<script type="text/javascript" src="/bitrix/templates/main_template/components/bitrix/news.list/main_slider/rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
<script type="text/javascript" src="/bitrix/templates/main_template/components/bitrix/news.list/main_slider/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>    
<script type="text/javascript" src="/bitrix/templates/main_template/components/bitrix/news.list/main_slider/rs-plugin/js/revSliderHide.js"></script>    

<link rel="stylesheet" type="text/css" href="/bitrix/templates/main_template/components/bitrix/news.list/main_slider/rs-plugin/css/settings.css" media="screen" />
<link rel="stylesheet" type="text/css" href="/bitrix/templates/main_template/components/bitrix/news.list/main_slider/rs-plugin/css/captions.css" media="screen" />


<div class="bannercontainer-simple-outer">
<div class="bannercontainer-simple">
    <div class="banner-simple">
	<ul>
		<?foreach($arResult["ITEMS"] as $arItem):?>
			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			
			/** проверка ссылок **/
/*if($arItem["DETAIL_TEXT"] != "") {
				$url = $arItem["DETAIL_PAGE_URL"];
			} else {
				if($arItem["PROPERTIES"]["ALT_URL"]["VALUE"] != "" || $arItem["PROPERTIES"]["PRE_ORDER_PRODUCT_NAME"]["VALUE"] == "") {
					$url = 	$arItem["PROPERTIES"]["USER_URL"]["VALUE"];
				} elseif($arItem["PROPERTIES"]["PRE_ORDER_PRODUCT_NAME"]["VALUE"] != "" || $arItem["PROPERTIES"]["ALT_URL"]["VALUE"] == "") {
					$product_id = $arItem["PROPERTIES"]["PRE_ORDER_PRODUCT_NAME"]["VALUE"];
					$url = '/promotions/product.php?ELEMENT_ID=' . $product_id;
				} 
}*/

			if($arItem["DETAIL_TEXT"] != "") {
				$url = $arItem["DETAIL_PAGE_URL"];
			} else {
				$url = 	$arItem["PROPERTIES"]["ALT_URL"]["VALUE"];
			}

			?>
			<li <? echo $arItem["PROPERTIES"]["OPEN_BLANK"]["VALUE"] ? 'data-blank="blank"' :''; ?> data-transition="<? echo $arItem["PROPERTIES"]["SLIDER_SWITCH"]["VALUE"]; ?>" data-slotamount="1" data-masterspeed="300" class="slider_li_elem" title="<?echo $arItem["PROPERTIES"]["ALT_URL"]["VALUE"];?>" data-url="<? echo $url; ?>">
				
				
					<?if(!$arItem["PROPERTIES"]["BACKGROUND_SLIDER"]["VALUE"] == "") {?>
						<?$arFile = CFile::GetFileArray($arItem["PROPERTIES"]["BACKGROUND_SLIDER"]["VALUE"]);?>
						<img src="<? echo $arFile["SRC"]; ?>">
					<?} else {}?>

					<?
						/** здесь вывожу прикрепленные эффекты **/
						foreach ($arItem["PROPERTIES"]["SLIDER_EFFECTS"]["VALUE"] as $key => $value) {
							$APPLICATION->IncludeComponent("bitrix:news.detail", "slider_caption_component", array(
	"IBLOCK_TYPE" => "content",
	"IBLOCK_ID" => "13",
	"ELEMENT_ID" => $value,
	"ELEMENT_CODE" => "",
	"CHECK_DATES" => "Y",
	"FIELD_CODE" => array(
		0 => "",
		1 => "",
	),
	"PROPERTY_CODE" => array(
		0 => "caption_data_start",
		1 => "caption_data_select",
		2 => "caption_data_y",
		3 => "caption_data_x",
		4 => "caption_options",
		5 => "caption_data_speed",
		6 => "caption_data_text",
		7 => "caption_data_easing",
		8 => "caption_data_img",
		9 => "",
	),
	"IBLOCK_URL" => "",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "N",
	"CACHE_TIME" => "36000000",
	"CACHE_GROUPS" => "Y",
	"META_KEYWORDS" => "-",
	"META_DESCRIPTION" => "-",
	"BROWSER_TITLE" => "-",
	"SET_STATUS_404" => "N",
	"SET_TITLE" => "N",
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
	"ADD_SECTIONS_CHAIN" => "N",
	"ADD_ELEMENT_CHAIN" => "N",
	"ACTIVE_DATE_FORMAT" => "d.m.Y",
	"USE_PERMISSIONS" => "N",
	"PAGER_TEMPLATE" => "",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "Y",
	"PAGER_TITLE" => "Страница",
	"PAGER_SHOW_ALL" => "Y",
	"DISPLAY_DATE" => "Y",
	"DISPLAY_NAME" => "Y",
	"DISPLAY_PICTURE" => "Y",
	"DISPLAY_PREVIEW_TEXT" => "Y",
	"USE_SHARE" => "N",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);
						}
						
					?>
				
			</li>
		<?endforeach;?>
	</ul>
    </div>

</div>
</div>
<script>
    jQuery(document).ready(function() {
       jQuery('.banner-simple').revolution(
          {
              delay:5500,
              startheight:360,
              startwidth:950,
    
              hideThumbs:false,
    
              thumbWidth:100,   
              thumbHeight:50,
              thumbAmount:5,
    
              navigationType:"bullet",                    
              navigationArrows:"verticalcentered",      
              navigationStyle:"round",              
    
              touchenabled:"on",                    
              onHoverStop:"on",                 
    
              navOffsetHorizontal:0,
              navOffsetVertical:20,
    
              stopAtSlide:-1,
              stopAfterLoops:-1,
    
              shadow:1,                     
              fullWidth:"off"                   
          });
		jQuery('.slider_li_elem').on('click touchend',function(e){
			e.preventDefault();
			elem = $(this);
			url = elem.data('url');
			blank = elem.data('blank');
			if (blank) {
				window.open(url);
			} else {
				window.location.href = url;
			}
		});
    });
</script>  
