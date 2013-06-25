<?php

/**
 * Copyright (C) <2013> <VRobin,healthlolicon@gmail.com>
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
$xml = <<<EOT
<?xml version='1.0' encoding='UTF-8'?>
<eveapi version="2">
  <currentTime>2010-06-17 18:15:01</currentTime>
  <result>
    <rowset name="kills" key="killID" columns="killID,solarSystemID,killTime,moonID">
      <row killID="63" solarSystemID="30000848" killTime="2007-11-15 15:36:00" moonID="0">
        <victim characterID="150340823" characterName="Dieinafire" corporationID="1000169"
                corporationName="Center for Advanced Studies" allianceID="0"
                allianceName="" factionID="0" factionName=""
                damageTaken="6378" shipTypeID="12003" />
        <rowset name="attackers" columns="characterID,characterName,corporationID,corporationName,allianceID,allianceName,
                factionID,factionName,securityStatus,damageDone,finalBlow,weaponTypeID,shipTypeID">
          <row characterID="0" characterName="" corporationID="1000127" corporationName="Guristas"
               allianceID="0" allianceName="" factionID="0" factionName="" securityStatus="0" 
               damageDone="6313" finalBlow="1" weaponTypeID="0" shipTypeID="203" />
          <row characterID="0" characterName="" corporationID="150279367" corporationName="Starbase Anchoring Corp"
               allianceID="0" allianceName="" securityStatus="0" damageDone="65" finalBlow="0"
               weaponTypeID="0" shipTypeID="16632" />
        </rowset>
        <rowset name="items" columns="typeID,flag,qtyDropped,qtyDestroyed,singleton" />
      </row>
      <row killID="62" solarSystemID="30000848" killTime="2007-11-15 14:48:00" moonID="0">
        <victim characterID="150340823" characterName="Dieinafire" corporationID="1000169"
                corporationName="Center for Advanced Studies" allianceID="0"
                allianceName="" factionID="0" factionName=""
                damageTaken="455" shipTypeID="606" />
        <rowset name="attackers" columns="characterID,characterName,corporationID,corporationName,allianceID,allianceName,
                factionID,factionName,securityStatus,damageDone,finalBlow,weaponTypeID,shipTypeID">
          <row characterID="0" characterName="" corporationID="1000127" corporationName="Guristas"
               allianceID="0" allianceName="" factionID="0" factionName="" securityStatus="0" 
               damageDone="394" finalBlow="1" weaponTypeID="0" shipTypeID="23328" />
          <row characterID="150131146" characterName="Mark Player" corporationID="150147571"
               corporationName="Peanut Butter Jelly Time" allianceID="150148475"
               allianceName="Margaritaville" securityStatus="0.3" damageDone="0"
               finalBlow="0" weaponTypeID="25715" shipTypeID="24698" />
        </rowset>
        <rowset name="items" columns="typeID,flag,qtyDropped,qtyDestroyed,singleton">
          <row typeID="3520" flag="0" qtyDropped="3" qtyDestroyed="1" singleton="0" />
          <row typeID="12076" flag="0" qtyDropped="0" qtyDestroyed="1" singleton="0">
            <rowset name="items" columns="typeID,flag,qtyDropped,qtyDestroyed,singleton">
              <row typeID="12259" flag="0" qtyDropped="0" qtyDestroyed="1" singleton="0" />
              <row typeID="1236" flag="0" qtyDropped="2" qtyDestroyed="1" singleton="0" />
              <row typeID="2032" flag="0" qtyDropped="1" qtyDestroyed="1" singleton="0" />
            </rowset>
          </row>
          <row typeID="12814" flag="0" qtyDropped="1" qtyDestroyed="3" singleton="0" />
          <row typeID="2364" flag="0" qtyDropped="0" qtyDestroyed="3" singleton="0" />
          <row typeID="26070" flag="0" qtyDropped="0" qtyDestroyed="2" singleton="0" />
          <row typeID="2605" flag="0" qtyDropped="1" qtyDestroyed="0" singleton="0" />
        </rowset>
      </row>
    </rowset>
  </result>
  <cachedUntil>2010-06-17 19:15:01</cachedUntil>
</eveapi>
EOT;

$object = simplexml_load_string($xml);
define('IN_REVEAPI', TRUE);
require dirname(__FILE__).'/class/RResult.class.php';
$result = new RResult($object);
print_r($result->result);
?>
