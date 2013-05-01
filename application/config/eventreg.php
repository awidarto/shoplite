<?php

return array(
		'collectiontype' => array(
			'attendee'=>'Attendee',
			'visitor'=>'Visitor',
			'official'=>'Official',
			//'exhibitor' => 'Exhibitor'
			),
		'officials' => array(
			'COM'=>'Committee',
			'BOD'=>'Board of Director IPA',
			'MDA'=>'Media',
			'ORG'=>'Organizer',
			//'CTR'=>'Contractor',
			//'WRK'=>'Worker',
			//'BA30'=>'Booth Assistant 30',
			//'BA150'=>'Booth Assistant 150',
			'SVO'=>'Student Volunteer',
			'SCR'=>'Security',
			//'OTS'=>'On-Site Technical Support',
			//'ECP'=>'EC Participant',
			//'TAP'=>'Technical Assistant Pre-Event'
		),
		'visitors' => array(
			'VS'=>'Walk In Visitor',
			'VIP'=>'VIP',
			'VVIP'=>'VVIP',
			'OC'=>'Other Complimentary'
		),
		'galadinner'=>1,

		'reg_admin_email'=>'conventionipa2013@dyandra.com',
		'reg_admin_name'=>'37th IPA Convex Register',

		'reg_dyandra_admin_email'=>'conventionipa2013@dyandra.com',
		'reg_dyandra_admin_name'=>'37th IPA Convex Register',

		'reg_exhibitor_admin_email'=>'exhibitionipa2013@dyandra.com',
		'reg_exhibitor_admin_name'=>'37th IPA Exhibitor Registration',
		
		'reg_finance_email'=>'conventionipa2013@dyandra.com',
		'reg_finance_name'=>'37th IPA Convex Finance',



		'emailpichall'=>array(
			'mainlobby1'=>array('email'=>'trisa@dyandra.com','name'=>'Trisa'),
			'mainlobby2'=>array('email'=>'rachel.pardede@dyandra.com','name'=>'Rachel'),
			'assembly1'=>array('email'=>'kusuma.ardina@dyandra.com','name'=>'Dina'),
			'assembly2'=>array('email'=>'talitha.sabrina@dyandra.com','name'=>'Talitha'),
			'cendrawasih1'=>array('email'=>'dian@dyandra.com','name'=>'Dian'),
			'cendrawasih2'=>array('email'=>'anita.afriani@dyandra.com','name'=>'Anita'),
			'halla1'=>array('email'=>'tia.hamidah@dyandra.com','name'=>'Tia'),
			'halla2'=>array('email'=>'wulan.septiani@dyandra.com','name'=>'Wulan'),
			'hallb1'=>array('email'=>'raymond@dyandra.com','name'=>'Raymond'),
			'hallb2'=>array('email'=>'rain.januardo@dyandra.com','name'=>'Rain')
		),

		'paystatus'=>array(
			'unpaid'=>'Unpaid',
			'paid'=>'Paid',
			'cancel'=>'Cancel',
			'free'=>'Free of Charge'
		),

		'systemstatus'=>array(
			'operationalform'=>'closed',
			
		),

		
		'resendemailtype'=>array(
			'email.regsuccess'=>'Registration',
			/*'reset'=>'Reset Password',
			'golfinfo'=>'Golf Payment Information',
			'convinfo'=>'Convention Payment Information',
			'boothinfo'=>'Convention & Golf Payment Information',
			'golfconfirm'=>'Golf Payment Confirmation',
			'convconfirm'=>'Convention Payment Confirmation',
			'boothconfirm'=>'Convention & Golf Payment Confirmation',*/
		),

		'exhibitoremailtype'=>array(
			'exhibitor.regsuccess'=>'Registration',
			/*'reset'=>'Reset Password',
			'golfinfo'=>'Golf Payment Information',
			'convinfo'=>'Convention Payment Information',
			'boothinfo'=>'Convention & Golf Payment Information',
			'golfconfirm'=>'Golf Payment Confirmation',
			'convconfirm'=>'Convention Payment Confirmation',
			'boothconfirm'=>'Convention & Golf Payment Confirmation',*/
		),

		'formstatus'=>array(
			
			'revision'=>'Revision',
			'approved'=>'Approved',
			'paid'=>'Paid'
			/*'reset'=>'Reset Password',
			'golfinfo'=>'Golf Payment Information',
			'convinfo'=>'Convention Payment Information',
			'boothinfo'=>'Convention & Golf Payment Information',
			'golfconfirm'=>'Golf Payment Confirmation',
			'convconfirm'=>'Convention Payment Confirmation',
			'boothconfirm'=>'Convention & Golf Payment Confirmation',*/
		),

		'formindividualstatus'=>array(
			'-'=>'Status',
			'open'=>'Open',
			'true'=>'Submitted',
		),

		'formindividualno'=>array(
			'-'=>'Form No.',
			'1'=>'1',
			'2'=>'2',
			'3'=>'3',
			'4'=>'4',
			'5'=>'5',
			'6'=>'6',
			'7'=>'7',
			'8'=>'8',
			'9'=>'9',
			'10'=>'10',
			'12'=>'11',
			'12'=>'12',
		),

		'golfquota'=>80,

		'pinsupervisorconvention'=>'12345',
		'pinsupervisorexhibitor'=>'123456',

		'exhibitorassistanttype'=>array(
			'freepassname'=>'m',
			'boothassistant'=>'h',
			'addboothname'=>'a',
		),

		'currencyconversion'=>9800,
		
		'conventionrate'=>array(
			'PD-earlybird'=>4500000,
			'PD-normal'=>5000000,
			'PO-earlybird'=>500,
			'PO-normal'=>550,
			'SD'=>400000,
			'SO'=>120
		),
		
		
		'earlybirdconventiondate'=>'2013-03-16 00:01',

		'convetionfee'=>array(
			'PO'=>500,
			'PD'=>4500000,
			'SD'=>400000,
			'SO'=>120
		),

		'golffee'=>2500000,
		'valid_heads'=>array(
			'no',
			'username',
			'inv_letter',
			'salutation',
			'firstname',
			'lastname',
			'position_division',
			'email',
			'mobile',
			'company',
			'companys_npwp',
			'address_1',
			'address_2',
			'city',
			'zip',
			'country',
			'company_country_code',
			'company_area_code',
			'phone',
			'fax_country_code',
			'fax_area_code',
			'fax',
			'invoice_address_conv',
			'registertype',
			'galadinner',
			'golf'
		),

		'valid_head_selects'=>array(
			'unmapped'=>'unmapped',
			'no'=>'no',
			'username'=>'username',
			'inv_letter'=>'inv_letter',
			'salutation'=>'salutation',
			'firstname'=>'firstname',
			'lastname'=>'lastname',
			'position_division'=>'position_division',
			'email'=>'email',
			'mobile'=>'mobile',
			'company'=>'company',
			'companys_npwp'=>'companys_npwp',
			'address_1'=>'address_1',
			'address_2'=>'address_2',
			'city'=>'city',
			'zip'=>'zip',
			'country'=>'country',
			'company_country_code'=>'company_country_code',
			'company_area_code'=>'company_area_code',
			'phone'=>'phone',
			'fax_country_code'=>'fax_country_code',
			'fax_area_code'=>'fax_area_code',
			'fax'=>'fax',
			'invoice_address_conv'=>'invoice_address_conv',
			'registertype'=>'registertype',
			'galadinner'=>'galadinner',
			'golf'=>'golf'
		),


		'attendee_map'=>array(
			'inv_letter'=>'inv_letter',
			'salutation'=>'salutation',
			'firstname'=>'firstname',
			'lastname'=>'lastname',
			'position_division'=>'position',
			'email'=>'email',
			'mobile'=>'mobile',
			'company'=>'company',
			'companys_npwp'=>'companys_npwp',
			'address_1'=>'address_1',
			'address_2'=>'address_2',
			'city'=>'city',
			'zip'=>'zip',
			'country'=>'country',

			'company_country_code'=>'companyphonecountry',
			'company_area_code'=>'companyphonearea',
			'phone'=>'companyphone',

			'fax_country_code'=>'companyfaxcountry',
			'fax_area_code'=>'companyfaxarea',
			'fax'=>'companyfax',

			'invoice_address_conv'=>'invoice_address_conv',
			'registertype'=>'regtype',
			'galadinner'=>'attenddinner',
			'golf'=>'golf'
		),

		'attendee_template'=>array(

			'address'=> '',
			'address_1'=> '',
			'address_2'=> '',
			'addressInvoice'=> '',
			'addressInvoice_1'=> '',
			'addressInvoice_2'=> '',
			'invoice_address_conv'=>'',
			'attenddinner'=> '',
			'city'=> '',
			'cityInvoice'=> '',
			'company'=> '',
			'companyInvoice'=> '',


			'companyfaxcountry'=> '',
			'companyfaxarea'=> '',
			'companyfax'=> '',

			'companyphonecountry'=> '',
			'companyphonearea'=> '',
			'companyphone'=> '',


			'companyphoneInvoiceCountry'=> '',
			'companyphoneInvoiceArea'=> '',
			'companyphoneInvoice'=> '',


			'companyfaxInvoiceCountry'=> '',
			'companyfaxInvoiceArea'=> '',
			'companyfaxInvoice'=> '',

			'confirmation'=> 'none',
			'country'=> '',
			'countryInvoice'=> '',
			'email'=> '',
			'firstname'=> '',
			'golf'=> '',
			'golfSequence'=> 0,
			'lastname'=> '',
			'mobile'=> '',
			'npwp'=> '',
			'npwpInvoice'=> '',
			'pass'=> '',
			'golfPaymentStatus'=> 'unpaid',
			'conventionPaymentStatus'=> 'unpaid',
			'paymentStatus'=>'',
			'position'=> '',
			'registrationnumber'=> '',
			'regtype'=> '',
			'role'=> 'attendee',
			'salutation'=> '',
			'zip'=> '',
			'zipInvoice'=> ''
			//normalize
			
			

		),

		'attendee_csv_template'=>array(
			//new template
			'registrationnumber'=> '',
			'salutation'=> '',
			'firstname'=> '',
			'lastname'=> '',
			'position'=> '',
			'email'=> '',
			'mobile no.'=> '',
			'company'=> '',
			'npwp'=> '',
			'companyphonecountry'=> '',
			'companyphonearea'=> '',
			'companyphone'=> '',
			'companyphone'=> '',
			'companyfaxcountry'=> '',
			'companyfaxarea'=> '',
			'companyfax'=> '',
			'address_1'=> '',
			'address_2'=> '',
			'city'=> '',
			'zip'=> '',
			'country'=> '',
			'companyInvoice'=> '',
			'npwpInvoice'=> '',
			'companyphoneInvoiceCountry'=> '',
			'companyphoneInvoiceArea'=> '',
			'companyphoneInvoice'=> '',
			'companyfaxInvoiceCountry'=> '',
			'companyfaxInvoiceArea'=> '',
			'companyfaxInvoice'=> '',
			'addressInvoice_1'=> '',
			'addressInvoice_2'=> '',
			'cityInvoice'=> '',
			'zipInvoice'=> '',
			'countryInvoice'=> '',
			'reg PD'=>'',
			'reg PO'=>'',
			'reg SD'=>'',
			'reg SO'=>'',
			'foc'=>'',
			'attenddinner'=> '',
			'Golf'=> '',
			'totalIDR'=> '',
			'totalUSD'=> '',
			'PIC salutation'=> '',
			'PIC firstname'=> '',
			'PIC lastname'=> '',
			'PIC position'=> '',
			'PIC company'=> '',
			'PIC email'=> '',
			'PIC mobile'=> '',
			'PIC address1'=> '',
			'PIC address2'=> '',
			'PIC city'=> '',
			'PIC zipcode'=> '',
			'PIC country'=> '',
			'groupname'=> '',
			'address'=>''
		),

		'electriclist' =>array(
			'2A / 1 ph / 440 Watt',
			'4A / 1 ph / 880 Watt',
			'6A / 1 ph / 1.320 Watt',
			'10A / 1 ph / 2.200 Watt</em>',
			'16A / 1 ph / 3.520 Watt',
			'32A / 1 ph / 7.040 Watt',
			'16A / 3 ph / 10.560 Watt',
			'32A / 3 ph / 21.120 Watt</em>',
			'60A / 3 ph / 39.600 Watt'
		),

		'phonelist' =>array(
			'Dial 9',
			'Hotline'
		),


		'furniturelist' =>array(
			'Folding chair white',
			'Upright chair red',
			'Barstool with backrest',
			'Reception desk',
			'Lockable cupboard',
			'Round table with glass top'
		),

		'internetlist' =>array(
			'Package : 1 Mbps',
			'Package : 2 Mbps'
		),
		'kiosklist' =>array(
			'Type 1 : Infostar ',
			'Type 2 : Elegance '
		),

		'exhibitor_valid_heads'=>array(
			'no',
			'first_name',
			'last_name',
		),

		'exhibitor_valid_head_selects'=>array(
			'unmapped'=>'unmapped',
			'no'=>'no',
			'first_name'=>'first_name',
			'last_name'=>'last_name',
		),


		


		'exhibitor_map'=>array(

			'first_name'=>'firstname',
			'last_name'=>'lastname',
		),

		'exhibitor_template'=>array(

			'firstname'=> '',
			'lastname'=> '',

		),

		'exhibitor_valid_heads'=>array(
			'no',
			'first_name',
			'last_name',
		),

		'exhibitor_valid_head_selects'=>array(
			'unmapped'=>'unmapped',
			'no'=>'no',
			'first_name'=>'first_name',
			'last_name'=>'last_name',
		),

		'boothpass_valid_heads'=>array(
			'no',
			'fullname',
		),

		'boothpass_valid_head_selects'=>array(
			'unmapped'=>'unmapped',
			'no'=>'no',
			'fullname'=>'fullname',
		),

		'attendee_valid_heads'=>array(
			'no',
			'username',
			'inv_letter',
			'salutation',
			'firstname',
			'lastname',
			'position_division',
			'email',
			'mobile',
			'company',
			'companys_npwp',
			'address_1',
			'address_2',
			'city',
			'zip',
			'country',
			'company_country_code',
			'company_area_code',
			'phone',
			'fax_country_code',
			'fax_area_code',
			'fax',
			'invoice_address_conv',
			'registertype',
			'galadinner',
			'golf'
		),

		'attendee_valid_head_selects'=>array(
			'unmapped'=>'unmapped',
			'no'=>'no',
			'username'=>'username',
			'inv_letter'=>'inv_letter',
			'salutation'=>'salutation',
			'firstname'=>'firstname',
			'lastname'=>'lastname',
			'position_division'=>'position_division',
			'email'=>'email',
			'mobile'=>'mobile',
			'company'=>'company',
			'companys_npwp'=>'companys_npwp',
			'address_1'=>'address_1',
			'address_2'=>'address_2',
			'city'=>'city',
			'zip'=>'zip',
			'country'=>'country',
			'company_country_code'=>'company_country_code',
			'company_area_code'=>'company_area_code',
			'phone'=>'phone',
			'fax_country_code'=>'fax_country_code',
			'fax_area_code'=>'fax_area_code',
			'fax'=>'fax',
			'invoice_address_conv'=>'invoice_address_conv',
			'registertype'=>'registertype',
			'galadinner'=>'galadinner',
			'golf'=>'golf'
		),


		'attendee_map'=>array(
			'inv_letter'=>'inv_letter',
			'salutation'=>'salutation',
			'firstname'=>'firstname',
			'lastname'=>'lastname',
			'position_division'=>'position',
			'email'=>'email',
			'mobile'=>'mobile',
			'company'=>'company',
			'companys_npwp'=>'companys_npwp',
			'address_1'=>'address_1',
			'address_2'=>'address_2',
			'city'=>'city',
			'zip'=>'zip',
			'country'=>'country',

			'company_country_code'=>'companyphonecountry',
			'company_area_code'=>'companyphonearea',
			'phone'=>'companyphone',

			'fax_country_code'=>'companyfaxcountry',
			'fax_area_code'=>'companyfaxarea',
			'fax'=>'companyfax',

			'invoice_address_conv'=>'invoice_address_conv',
			'registertype'=>'regtype',
			'galadinner'=>'attenddinner',
			'golf'=>'golf'
		),

		'attendee_template'=>array(

			'address'=> '',
			'address_1'=> '',
			'address_2'=> '',
			'addressInvoice'=> '',
			'addressInvoice_1'=> '',
			'addressInvoice_2'=> '',
			'invoice_address_conv'=>'',
			'attenddinner'=> '',
			'city'=> '',
			'cityInvoice'=> '',
			'company'=> '',
			'companyInvoice'=> '',


			'companyfaxcountry'=> '',
			'companyfaxarea'=> '',
			'companyfax'=> '',

			'companyphonecountry'=> '',
			'companyphonearea'=> '',
			'companyphone'=> '',


			'companyphoneInvoiceCountry'=> '',
			'companyphoneInvoiceArea'=> '',
			'companyphoneInvoice'=> '',


			'companyfaxInvoiceCountry'=> '',
			'companyfaxInvoiceArea'=> '',
			'companyfaxInvoice'=> '',

			'confirmation'=> 'none',
			'country'=> '',
			'countryInvoice'=> '',
			'email'=> '',
			'firstname'=> '',
			'golf'=> '',
			'golfSequence'=> 0,
			'lastname'=> '',
			'mobile'=> '',
			'npwp'=> '',
			'npwpInvoice'=> '',
			'pass'=> '',
			'golfPaymentStatus'=> 'unpaid',
			'conventionPaymentStatus'=> 'unpaid',
			'paymentStatus'=>'',
			'position'=> '',
			'registrationnumber'=> '',
			'regtype'=> '',
			'role'=> 'attendee',
			'salutation'=> '',
			'zip'=> '',
			'zipInvoice'=> '',


			//normalize



		),

		'attendee_csv_template'=>array(
			//new template
			'registrationnumber'=> '',
			'salutation'=> '',
			'firstname'=> '',
			'lastname'=> '',
			'position'=> '',
			'email'=> '',
			'mobile no.'=> '',
			'company'=> '',
			'npwp'=> '',
			'companyphonecountry'=> '',
			'companyphonearea'=> '',
			'companyphone'=> '',
			'companyphone'=> '',
			'companyfaxcountry'=> '',
			'companyfaxarea'=> '',
			'companyfax'=> '',
			'address_1'=> '',
			'address_2'=> '',
			'city'=> '',
			'zip'=> '',
			'country'=> '',
			'companyInvoice'=> '',
			'npwpInvoice'=> '',
			'companyphoneInvoiceCountry'=> '',
			'companyphoneInvoiceArea'=> '',
			'companyphoneInvoice'=> '',
			'companyfaxInvoiceCountry'=> '',
			'companyfaxInvoiceArea'=> '',
			'companyfaxInvoice'=> '',
			'addressInvoice_1'=> '',
			'addressInvoice_2'=> '',
			'cityInvoice'=> '',
			'zipInvoice'=> '',
			'countryInvoice'=> '',
			'regPD'=>'',
			'regPO'=>'',
			'regSD'=>'',
			'regSO'=>'',
			'foc'=>'',
			'attenddinner'=> '',
			'Golf'=> '',
			'totalIDR'=> '',
			'totalUSD'=> '',
			'PIC salutation'=> '',
			'PIC firstname'=> '',
			'PIC lastname'=> '',
			'PIC position'=> '',
			'PIC company'=> '',
			'PIC email'=> '',
			'PIC mobile'=> '',
			'PIC address1'=> '',
			'PIC address2'=> '',
			'PIC city'=> '',
			'PIC zipcode'=> '',
			'PIC country'=> '',
			'groupname'=> '',
			'address'=>'',
			'conventionPaymentStatus'=>'',
			'golfPaymentStatus'=>'',
			'notes'=>''
		)
		
	);


?>