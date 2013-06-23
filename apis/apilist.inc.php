<?php

/**
 * Copyright (C) <2013> <Robin,healthlolicon@gmail.com>
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated 
 * documentation files (the "Software"), to deal in the Software without restriction, including without limitation 
 * the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and 
 * to permit persons to whom the Software is furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO 
 * THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE 
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, 
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
if (!defined('IN_REVEAPI') || IN_REVEAPI != TRUE)
    return;

return array(
//    Api Name => AccessMark
    'account' => array(
	'AccountStatus' => 33554432,
	'APIKeyInfo' => 0,
	'Characters' => 0,
    ),
    'char' => array(
	'AccountBalance' =>	    1,
	'AssetList' =>		    2,
	'CalendarEventAttendees' => 4,
	'CharacterSheet' =>	    8,
	'ContactList' =>	    16,
	'ContactNotifications' =>   32,
	'FacWarStats' =>	    64,
	'IndustryJobs' =>	    128,
	'Killlog' =>		    256,
	'MailBodies' =>		    512,
	'MailingLists' =>	    1024,
	'MailMessages' =>	    2048,
	'MarketOrders' =>	    4096,
	'Medals' =>		    8192,
	'Notifications' =>	    16384,
	'NotificationTexts' =>	    32768,
	'Research' =>		    65536,
	'SkillInTraining' =>	    131072,
	'SkillQueue' =>		    262144,
	'Standings' =>		    524288,
	'UpcomingCalendarEvents' => 1048576,
	'WalletJournal' =>	    2097152,
	'WalletTransactions' =>	    4194304,
	'Contracts' =>		    67108864,
	'ContractItems' =>	    67108864,
	'ContractBids' =>	    67108864,
	'Locations' =>		    134217728,
    ),
    'corp' => array(
	'AccountBalance' =>	    1,
	'AssetList' =>		    2,
	'MemberMedals' =>	    4,
	'CorporationSheet' =>	    8,
	'ContactList' =>	    16,
	'ContainerLog' =>	    32,
	'FacWarStats' =>	    64,
	'IndustryJobs' =>	    128,
	'Killlog' =>		    256,
	'MemberSecurity' =>	    512,
	'MemberSecurityLog' =>	    1024,
	'MemberTracking' =>	    2048,
	'MarketOrders' =>	    4096,
	'Medals' =>		    8192,
	'OutpostList' =>	    16384,
	'OutpostServiceDetail' =>   32768,
	'Shareholders' =>	    65536,
	'StarbaseDetail' =>	    131072,
	'Standings' =>		    262144,
	'StarbaseList' =>	    524288,
	'WalletJournal' =>	    1048576,
	'WalletTransactions' =>	    2097152,
	'Titles' =>		    4194304,
	'Contracts' =>		    8388608,
	'ContractItems' =>	    8388608,
	'ContractBids' =>	    8388608,
	'Locations' =>		    16777216,
    ),
    'eve' => array(
	'AllianceList' => 0,
	'CertificateTree' => 0,
	'CharacterID' => 0,
	'CharacterInfo' => array(0, 8388608, 16777216),
	'CharacterName' => 0,
	'ConquerableStationList' => 0,
	'ErrorList' => 0,
	'FacWarStats' => 0,
	'FacWarTopStats' => 0,
	'RefTypes' => 0,
	'SkillTree' => 0,
	'TypeName' => 0,
    ),
    'map' => array(
	'FacWarSystems' => 0,
	'Jumps' => 0,
	'Kills' => 0,
	'Sovereignty' => 0,
	'SovereigntyStatus' => 0,
    ),
    'server' => array('ServerStatus' => 0),
    'api' => array('calllist' => 0),
	//http://wiki.eve-id.net/APIv2_Page_Index?title=APIv2_Page_Index&action=edit
	//https://api.eveonline.com/api/calllist.xml.aspx
);
?>