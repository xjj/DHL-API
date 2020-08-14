<?php
/**
 * Note : Code is released under the GNU LGPL
 *
 * Please do not change the header of this file
 *
 * This library is free software; you can redistribute it and/or modify it under the terms of the GNU
 * Lesser General Public License as published by the Free Software Foundation; either version 2 of
 * the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
 * without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * See the GNU Lesser General Public License for more details.
 */

/**
 * File:        ShipmentRequest.php
 * Project:     DHL API
 *
 * @author      Al-Fallouji Bashar
 * @version     0.1
 */

namespace DHL\Entity\GB\MY;
use DHL\Entity\Base;

/**
 * ShipmentRequest Request model for DHL API
 */
class ShipmentRequest extends \DHL\Entity\GB\ShipmentRequest
{
    /**
     * Is this object a subobject
     * @var boolean
     */
    protected $_isSubobject = false;

    /**
     * Name of the service
     * @var string
     */
    protected $_serviceName = 'ShipmentRequest';

    /**
     * @var string
     * Service XSD
     */
    protected $_serviceXSD = 'ShipmentRequest.xsd';

    /**
     * @var string
     * The schema version
     */
    protected $_schemaVersion = '6.2';

    /**
     * Display the schema version
     * @var boolean
     */
    protected $_displaySchemaVersion = true;

    /**
     * Parameters to be send in the body
     * @var array
     */
    protected $_bodyParams = array(
        'RegionCode' => array(
            'type' => 'string',
            'required' => false,
            'subobject' => false,
            'comment' => 'RegionCode',
            'minLength' => '2',
            'maxLength' => '2',
            'enumeration' => 'AP,EU,AM',
        ), 
        'RequestedPickupTime' => array(
            'type' => 'string',
            'required' => false,
            'subobject' => false,
        ), 
        'NewShipper' => array(
            'type' => 'string',
            'required' => false,
            'subobject' => false,
        ), 
        'LanguageCode' => array(
            'type' => 'string',
            'required' => false,
            'subobject' => false,
            'comment' => 'ISO Language Code',
            'maxLength' => '2',
        ), 
        'PiecesEnabled' => array(
            'type' => 'string',
            'required' => false,
            'subobject' => false,
            'comment' => 'Pieces Enabling Flag',
            'enumeration' => 'Y,N',
        ), 
        'Billing' => array(
            'type' => 'Billing',
            'required' => false,
            'subobject' => true,
        ), 
        'Consignee' => array(
            'type' => 'Consignee',
            'required' => false,
            'subobject' => true,
        ), 
        'Commodity' => array(
            'type' => 'Commodity',
            'required' => false,
            'subobject' => true,
        ), 
        'Dutiable' => array(
            'type' => 'Dutiable',
            'required' => false,
            'subobject' => true,
        ), 
        'ExportDeclaration' => array(
            'type' => 'ExportDeclaration',
            'required' => false,
            'subobject' => true,
        ), 
        'Reference' => array(
            'type' => 'Reference',
            'required' => false,
            'subobject' => true,
        ),
        'PieceReference' => array(
            'type' => 'Reference',
            'required' => false,
            'subobject' => true,
        ),
        'ShipmentDetails' => array(
            'type' => 'ShipmentDetails',
            'required' => false,
            'subobject' => true,
        ), 
        'Shipper' => array(
            'type' => 'Shipper',
            'required' => false,
            'subobject' => true,
        ), 
        'SpecialService' => array(
            'disableParentNode' => true,
            'multivalues' => true,
            'type' => 'SpecialService',
            'required' => false,
            'subobject' => true,
        ), 
        'Notification' => array(
            'type' => 'Notification',
            'required' => false,
            'subobject' => true,
        ), 
        'Place' => array(
            'type' => 'Place',
            'required' => false,
            'subobject' => true,
        ), 
        'EProcShip' => array(
            'type' => 'string',
            'required' => false,
            'subobject' => false,
        ), 
        'Airwaybill' => array(
            'type' => 'string',
            'required' => false,
            'subobject' => false,
        ), 
        'DocImages' => array(
            'type' => 'DocImage',
            'multivalues' => true,
            'required' => false,
            'subobject' => true,
        ), 
        'LabelImageFormat' => array(
            'type' => 'string',
            'required' => false,
            'subobject' => false,
            'comment' => 'LabelImageFormat',
            'minLength' => '3',
            'maxLength' => '4',
            'enumeration' => 'PDF,ZPL2,EPL2',
        ), 
        'RequestArchiveDoc' => array(
            'type' => 'string',
            'required' => false,
            'subobject' => false,
        ),
        'NumberOfArchiveDoc' => array(
            'type' => 'integer',
            'required' => false,
            'subobject' => false,
        ),
        'Label' => array(
            'type' => 'Label',
            'required' => false,
            'subobject' => true,
        ), 
    );

    protected function initializeValues()
    {
        foreach ($this->_params as $name => $infos)
        {
            if (!$this->_isSubobject && isset($infos['subobject']) && $infos['subobject'])
            {
                if (isset($infos['multivalues']) && $infos['multivalues'])
                {
                    $this->_values[$name] = array();
                }
                else
                {
                    $tmp = get_class($this);
                    $parts = explode('\\', $tmp);
                    array_pop($parts);
                    $className = implode('\\', $parts) . '\\' . $infos['type'];
                    $className = str_replace(['Entity','MY\\'], ['Datatype',''], $className);
                    $this->_values[$name] = new $className();
                }
            }
            else
            {
                $this->_values[$name] = null;
            }
        }
    }

    public function toXML(\XMLWriter $xmlWriter = null)
    {
        $this->validateParameters();

        $xmlWriter = new \XMLWriter();
        $xmlWriter->openMemory();
        $xmlWriter->setIndent(true);
        $xmlWriter->startDocument('1.0', 'UTF-8');

        $xmlWriter->startElement('req:' . $this->_serviceName);
        $xmlWriter->writeAttribute('xmlns:req', self::DHL_REQ);
        $xmlWriter->writeAttribute('xmlns:xsi', self::DHL_XSI);
        $xmlWriter->writeAttribute('xsi:schemaLocation', self::DHL_REQ . ' ' .$this->_serviceXSD);

        if ($this->_displaySchemaVersion)
        {
            $xmlWriter->writeAttribute('schemaVersion', $this->_schemaVersion);
        }

        if (null !== $this->_xmlNodeName)
        {
            $xmlWriter->startElement($this->_xmlNodeName);
        }

        $xmlWriter->startElement('Request');
        $xmlWriter->startElement('ServiceHeader');
        foreach ($this->_headerParams as $name => $infos)
        {
            $xmlWriter->writeElement($name, $this->$name);
        }
        $xmlWriter->endElement(); // End of Request

        $xmlWriter->startElement('MetaData');
        $xmlWriter->writeElement('SoftwareName', 'DHLShipmentService');
        $xmlWriter->writeElement('SoftwareVersion', '1.0');


        $xmlWriter->endElement(); // End of Request
        $xmlWriter->endElement(); // End of ServiceHeader

        foreach ($this->_bodyParams as $name => $infos)
        {
            if ($this->$name)
            {
                if (is_object($this->$name))
                {
                    $this->$name->toXML($xmlWriter);
                }
                elseif (is_array($this->$name))
                {
                    if ('string' == $this->_params[$name]['type'])
                    {
                        foreach ($this->$name as $subelement)
                        {
                            $xmlWriter->writeElement($name, $subelement);
                        }
                    }
                    else
                    {
                        if (!isset($this->_params[$name]['disableParentNode']) || false == $this->_params[$name]['disableParentNode'])
                        {
                            $xmlWriter->startElement($name);
                        }

                        foreach ($this->$name as $subelement)
                        {
                            $subelement->toXML($xmlWriter);
                        }

                        if (!isset($this->_params[$name]['disableParentNode']) || false == $this->_params[$name]['disableParentNode'])
                        {
                            $xmlWriter->endElement();
                        }
                    }
                }
                else
                {
                    $xmlWriter->writeElement($name, $this->$name);
                }
            }
        }

        $xmlWriter->endElement(); // End of parent node

        // End of class name tag
        if (null !== $this->_xmlNodeName)
        {
            $xmlWriter->endElement();
        }

        $xmlWriter->endDocument();

        return $xmlWriter->outputMemory(true);
    }

}
