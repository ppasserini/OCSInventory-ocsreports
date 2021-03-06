<?php
/*
 * Copyright 2005-2016 OCSInventory-NG/OCSInventory-ocsreports contributors.
 * See the Contributors file for more details about them.
 *
 * This file is part of OCSInventory-NG/OCSInventory-ocsreports.
 *
 * OCSInventory-NG/OCSInventory-ocsreports is free software: you can redistribute
 * it and/or modify it under the terms of the GNU General Public License as
 * published by the Free Software Foundation, either version 2 of the License,
 * or (at your option) any later version.
 *
 * OCSInventory-NG/OCSInventory-ocsreports is distributed in the hope that it
 * will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty
 * of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with OCSInventory-NG/OCSInventory-ocsreports. if not, write to the
 * Free Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 */

if (AJAX) {
    ob_end_clean();
    parse_str($protectedPost['ocs']['0'], $params);
    $protectedPost += $params;
    ob_start();
}
print_item_header($l->g(1224));
if (!isset($protectedPost['SHOW'])) {
    $protectedPost['SHOW'] = 'NOSHOW';
}
$table_name = "sd_trays";
$tab_options = $protectedPost;
$tab_options['form_name'] = $form_name;
$tab_options['table_name'] = $table_name;
$list_fields = array($l->g(49) => 'NAME',
    $l->g(53) => 'DESCRIPTION',
    $l->g(1104) => 'LEVEL',
    $l->g(1225) => 'MAXCAPACITY');
$sql = prepare_sql_tab($list_fields);
$list_fields["PERCENT_BAR"] = 'CAPACITY';
$tab_options["replace_query_arg"]['CAPACITY'] = " round(100-(LEVEL*100/MAXCAPACITY)) ";
$list_col_cant_del = $list_fields;
$default_fields = $list_fields;
$sql['SQL'] = $sql['SQL'] . " , round(100-(LEVEL*100/MAXCAPACITY)) AS CAPACITY FROM %s WHERE (snmp_id=%s)";
$sql['ARG'][] = 'snmp_trays';
$sql['ARG'][] = $systemid;
$tab_options['ARG_SQL'] = $sql['ARG'];
$tab_options['LBL']['PERCENT_BAR'] = $l->g(1125);

$tab_options['REPLACE_WITH_LIMIT']['DOWN'][$l->g(1104)] = 0;
$tab_options['REPLACE_WITH_LIMIT']['DOWNVALUE'][$l->g(1104)] = $msq_tab_error;
$tab_options['REPLACE_WITH_LIMIT']['DOWN'][$l->g(1225)] = 0;
$tab_options['REPLACE_WITH_LIMIT']['DOWNVALUE'][$l->g(1225)] = $msq_tab_error;
$tab_options['REPLACE_WITH_LIMIT']['DOWN']['PERCENT_BAR'] = 0;
$tab_options['REPLACE_WITH_LIMIT']['DOWNVALUE']['PERCENT_BAR'] = $msq_tab_error;
$tab_options['REPLACE_WITH_LIMIT']['UP']['PERCENT_BAR'] = 100;
$tab_options['REPLACE_WITH_LIMIT']['UPVALUE']['PERCENT_BAR'] = $msq_tab_error;
ajaxtab_entete_fixe($list_fields, $default_fields, $tab_options, $list_col_cant_del);
if (AJAX) {
    ob_end_clean();
    tab_req($list_fields, $default_fields, $list_col_cant_del, $sql['SQL'], $tab_options);
    ob_start();
}
?>