<? 
defined('C5_EXECUTE') or die("Access Denied.");
?>
<?
// Adds the permissions specification for a given area to that area's
// javascript configuration object.
// $a - the area (REQUIRED)
// $ap - the area's permissions object (optional optimization)
// $c - the collection that the area is in (optional optimization)
// $cp - the collection's permissions object (optional optimization)

$ap = isset($ap) ? $ap : new Permissions($a);
$c = isset($c) ? $c : $a->getAreaCollectionObject();
$cp = isset($cp) ? $cp : new Permissions($cp);
?>

<script type="text/javascript">
ccm_areaMenuObj<?=$a->getAreaID()?>.canAddBlocks = <?= (int) ($ap->canAddBlocks() && $a->areaAcceptsBlocks()) ?>;
ccm_areaMenuObj<?=$a->getAreaID()?>.canWrite = <?=$ap->canWrite()?>;
<? if ($cp->canAdmin() && PERMISSIONS_MODEL != 'simple') { ?>
    ccm_areaMenuObj<?=$a->getAreaID()?>.canModifyGroups = true;
<? } ?>
<? if ($ap->canWrite() && ENABLE_AREA_LAYOUTS == true && (!$a->isGlobalArea()) && (!$c->isMasterCollection()) && $a->areaAcceptsBlocks()) { ?>
    ccm_areaMenuObj<?=$a->getAreaID()?>.canLayout = true;
<? } else { ?>
    ccm_areaMenuObj<?=$a->getAreaID()?>.canLayout = false;
<? } ?>
<? if ($ap->canWrite() && ENABLE_CUSTOM_DESIGN == true && (!$c->isMasterCollection() && $a->areaAcceptsBlocks())) { ?>
    ccm_areaMenuObj<?=$a->getAreaID()?>.canDesign = true;
<? } else { ?>
    ccm_areaMenuObj<?=$a->getAreaID()?>.canDesign = false;
<? } ?>
</script>
