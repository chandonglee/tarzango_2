<?php
 
 //Wish list global function for all modules
if (!function_exists('wishListInfo')) {

 function wishListInfo($module, $id){
 	$inwishlist = pt_isInWishList($module, $id);
 	if($inwishlist){
 	$html = '<div title="'.trans('028').'" data-toggle="tooltip" data-placement="left" id="'.$id.'" data-module="'.$module.'" class="wishlist wishlistcheck '.$module.'wishtext'.$id.' fav"><a  class="tooltip_flip tooltip-effect-1" href="javascript:void(0);"><span class="'.$module.'wishsign'.$id.' fav">-</span></a></div>';
 	}else{
 	$html = '<div  title="'.trans('029').'" data-toggle="tooltip" data-placement="left" id="'.$id.'" data-module="'.$module.'" class="wishlist wishlistcheck '.$module.'wishtext'.$id.'"><a class="tooltip_flip tooltip-effect-1" href="javascript:void(0);"><span class="'.$module.'wishsign'.$id.'">+</span></a></div>';
 	}

 	return $html;

 }

}

//Tours locations part on home page
if (!function_exists('toursWithLocations')) {

 function toursWithLocations(){
 	$phptravelsObj = phpTravelsObj();
 	$toursLib = $phptravelsObj->load->library('tours/tours_lib');
 	$totalLocations = 7;
 	$locationData = $toursLib->toursByLocations($totalLocations);
 	return $locationData;

 }

}