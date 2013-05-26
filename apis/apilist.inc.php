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
//    
    //Account 
    'AccountStatus' => 33554432,
    'APIKeyInfo' => 0,
    'Characters' => 0,
    //Character
    'AccountBalance' => 1,
    'AssetList' => 2,
    'CalendarEventAttendees' => 4,
    'CharacterSheet' => 8,
    'ContactList' => 16,
    'ContactNotifications' => 32,
    'Contracts' => 67108864,
    'ContractItems' => 67108864,
    'ContractBids' => 67108864,
    'FacWarStats'=>64,
    'IndustryJobs'=>128,
    'Killlog'=>256,
    'Locations'=>134217728,
    'MailBodies'=>512,
    'MailingLists'=>1024,
    //http://wiki.eve-id.net/APIv2_Page_Index?title=APIv2_Page_Index&action=edit
);
?>