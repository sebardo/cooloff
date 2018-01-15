<?php
if ($type == 'edit')
{
    echo select_tag('service_schedule[service_id]', objects_for_select(
        ServicePeer::getServicesByProfile(), 'getId', '__toString', $service_schedule->getServiceId()));
}
elseif ($type == 'list') {
    if ($service_schedule->getServiceId() != null) {
        echo $service_schedule->getService();
    }
}
elseif ($type == 'filter') {
    echo select_tag('filters[service_id]', options_for_select(ServicePeer::getArrayFiltro(), isset($filters['service_id']) ? $filters['service_id'] : null, 'include_blank=true'));
}

