<?php
namespace NethServer\Module\TrafficShaping;

/*
 * Copyright (C) 2011 Nethesis S.r.l.
 * 
 * This script is part of NethServer.
 * 
 * NethServer is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * NethServer is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with NethServer.  If not, see <http://www.gnu.org/licenses/>.
 */

use Nethgui\System\PlatformInterface as Validate;

/**
 * Configure traffic shaping rules of type port
 */
class Ports extends \Nethgui\Controller\TableController
{
    public function initialize()
    {

        $columns = array(
            'Key',
            'proto',
            'priority',
            'description',
            'Actions'
        );

        $this
            ->setTableAdapter($this->getPlatform()->getTableAdapter('tc','port'))
            ->setColumns($columns)
            ->addTableAction(new \NethServer\Module\TrafficShaping\Ports\Modify('create'))            
            ->addTableAction(new \Nethgui\Controller\Table\Help('Help'))
            ->addRowAction(new \NethServer\Module\TrafficShaping\Ports\Modify('update'))
            ->addRowAction(new \NethServer\Module\TrafficShaping\Ports\Modify('delete'))
        ;

        parent::initialize();
    }

    public function prepareViewForColumnPriority(\Nethgui\Controller\Table\Read $action, \Nethgui\View\ViewInterface $view, $key, $values, &$rowMetadata)
    {
        return $view->translate($values['priority']."_label");
    }
}

