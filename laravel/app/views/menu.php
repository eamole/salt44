<?php

Menu::make('menuBar',function($menu) {

	$menu->add("Home" 			, ['route' => 'home' ,'class' => 'navbar' ] );
	$menu->add("Therapists" 	, ['route' => 'therapistsDisplayAll' ,'class' => 'navbar' ] );
	$menu->add("Clients" 		, ['route' => 'clientsDisplayAll' ,'class' => 'navbar' ] );
	$menu->add("Appointments" 	, ['route' => 'apptsDisplayAll' ,'class' => 'navbar' ] );
	// $menu->add("Login" , ['route' => 'threapistsDisplayAll'] );

});
