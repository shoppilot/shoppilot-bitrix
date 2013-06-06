<?
$events = GetModuleEvents("shoppilot.reviews", "OnModuleUnInstall");
while($arEvent = $events->Fetch())
{
	if(strlen($arEvent["TO_CLASS"]) <= 0)
		$arEvent["CALLBACK"] = $arEvent["TO_METHOD"];
	ExecuteModuleEvent($arEvent);
}

if ($ex = $APPLICATION->GetException())
{
	echo CAdminMessage::ShowMessage(GetMessage("SHOPPILOT_REVIEWS_UNINSTALL_IMPOSSIBLE")."<br />".$ex->GetString());
	?>
	<form action="<?= $APPLICATION->GetCurPage()?>">
	<p>
		<input type="hidden" name="lang" value="<?echo LANG?>">
		<input type="submit" name="" value="<?echo GetMessage("MOD_BACK")?>">	
	</p>
	<form>
	<?
}
else
{
	?>
	<form action="<? $APPLICATION->GetCurPage() ?>">
	<?=bitrix_sessid_post()?>
		<input type="hidden" name="lang" value="<?= LANG ?>">
		<input type="hidden" name="id" value="shoppilot.reviews">
		<input type="hidden" name="uninstall" value="Y">
		<input type="hidden" name="step" value="2">
		<?CAdminMessage::ShowMessage(GetMessage("MOD_UNINST_WARN"))?>
		<p><?echo GetMessage("MOD_UNINST_SAVE")?></p>
		<p><input type="checkbox" name="savedata" id="savedata" value="Y" checked><label for="savedata"><?echo GetMessage("MOD_UNINST_SAVE_TABLES")?></label></p>
		<input type="submit" name="inst" value="<?echo GetMessage("MOD_UNINST_DEL")?>">
	</form>
	<?
}
?>