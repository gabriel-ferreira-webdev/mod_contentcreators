<?php
// No direct access
defined('_JEXEC') or die; ?>
<ul class="menu-cc mod-list">

<?php
// first line might not be necessary depending on Joomla version
JLoader::register('FieldsHelper', JPATH_ADMINISTRATOR . '/components/com_fields/helpers/fields.php');
$usersID = JAccess::getUsersByGroup(6);
$users = array();
foreach($usersID as $cUserID)
{
    $user[] = JFactory::getUser($cUserID);
    $userProfile[] = JUserHelper::getProfile( $cUserID );

}
function cmp($a, $b)
{
    return strcmp($a->name, $b->name);
}
function cmp2($a, $b)
{
    return strcmp($a->profile, $b->profile);
}

usort($user, "cmp");


for ($i=0; $i < count($user); $i++) {
  foreach ($userProfile as $ccp) {
  if ($user[$i]->{'id'} == $ccp->{"id"}) {


$customFields = FieldsHelper::getFields('com_users.user', JFactory::getUser($ccp->{"id"}), true);
foreach ($customFields as $ccf) {

if ($ccf->name == "blog-url") {

// echo '<pre>';
// print_r($customFields);
// echo '</pre>';
?>
<li class="<?php echo ($ccf->value); ?>">
<a href="<?php echo ($ccf->value); ?>">
<img src="<?php echo $ccp->{"profile"}["avatar"]; ?>" alt="">
<span class="image-title">
<?php
echo $user[$i]->{"name"};
?>
</span>
</a>
</li>
<?php
}
  }

}
}


    }
?>

</ul>
