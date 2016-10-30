<?php
/**
 * achievements module
 *
 * @package   bbguild
 * @copyright 2016 bbDKP <https://github.com/bbDKP>
 * @license   http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 */
namespace bbdkp\bbguild\views;

use bbdkp\bbguild\model\games\game;
use bbdkp\bbguild\model\games\rpg\achievement;

/**
 * Class viewachievements
 *
 * @package bbdkp\bbguild\views
 */
class viewachievements implements iviews
{
	private $navigation;
	public  $response;
	private $tpl;
	public $achievement;

	/**
	 * viewachievements constructor.
	 *
	 * @param \bbdkp\bbguild\views\viewnavigation $navigation
	 */
	public function __construct(viewnavigation $navigation)
	{
		$this->navigation = $navigation;
		$this->buildpage();
	}

	/**
	 *prepare the rendering
	 */
	public function buildpage()
	{
		global $template;
		$this->tpl = 'main.html';
		
		$achievements =  $this->navigation->guild->getGuildAchievements();
		
		foreach ($achievements as $achi)
		{
			$a = $achi;
			$achi['detail'] = new achievement($game, $achi[$i]['id']);
		}

		$i=0;
		/*
		foreach ($achievements['achievements'] as $id => $achievement)
		{
			$i++;
			switch ($achievement['type'])
			{
			case 'itemCraft' :
			case 'itemLoot' :
				$template->assign_block_vars(
					'activityfeed', array(
					'TYPE'      => 'ITEM',
					'ID'        => $id,
					'VERB'      => $user->lang('LOOTED'),
					'CHARACTER' => $achievement['character'],
					'TIMESTAMP' => (!empty($achievement['timestamp'])) ? $this->date_diff($achievement['timestamp']) . '&nbsp;' : '&nbsp;',
					'ITEM'      => isset($achievement['itemId']) ? $achievement['itemId'] : '',
					'CONTEXT'   => $achievement['context'],
					)
				);
				break;

			default:
				$a=$achievement['type'];
				break;

			}
			if ($i > 25)
			{
				break;
			}
		}
		*/

		$template->assign_vars(
			array(
			'EMBLEM'                =>  $this->navigation->guild->getEmblempath(),
			'GUILD_FACTION'         =>  $this->navigation->guild->getFactionname(),
			'S_DISPLAY_WOWACHIEVEMENTS'     => true,
			)
		);
		$title = $this->navigation->user->lang['WELCOME'];

		unset($newsarr);
		// fully rendered page source that will be output on the screen.
		$this->response = $this->navigation->helper->render($this->tpl, $title);

	}


}
