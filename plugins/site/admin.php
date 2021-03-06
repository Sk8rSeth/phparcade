<?php
function site_links()
{
    Administrations::addLink(gettext('site'), 'index.php?act=site');
}

Administrations::addSubLink(gettext('mainconfig'), 'index.php?act=site&mthd=site-config', 'site');
Administrations::addSubLink(gettext('theme'), 'index.php?act=site&mthd=theme-config', 'site');
Administrations::addSubLink(gettext('featureconfig'), 'index.php?act=site&mthd=feature-config', 'site');
function site_admin($mthd)
{
    $dbconfig = Core::getInstance()->getDBConfig();
    $prerequisites = Administrations::getPreReqs();
    $processUser = Administrations::getProcessUser();
    switch ($mthd) {
        case "":
        case 'home': ?>
			<div class="row">
				<div class="col-lg-12">
					<div class="container-fluid">
						<div class="jumbotron">
							<h1>Welcome!</h1>
							<p>Thanks for downloading phpArcade.  I'd like to let you know of a few things to help you along:</p>
							<ul>
								<li>Please file bugs or feature requests at
									<a href="<?php echo URL_GITHUB_PHPARCADE;?>issues">
										<?php echo Core::showGlyph('github');?> GitHub
									</a>
								</li>
								<li>As of now, there is no direct upgrade path from version to version</li>
								<li>Help -- in any form -- is <em>always</em> appreciated! <?php echo Core::showGlyph('smile-o');?></i></li>
							</ul>
							<!--<p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>-->
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix invisible"></div><?php
            /* Broken Block */
            if (Games::getGamesBrokenCount() > 0) {
                ?>
				<div class="col-lg-2 col-md-6">
					<div class="panel panel-<?php echo $prerequisites['broken_games'][0]; ?>">
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-3">
									<?php echo Core::showGlyph($prerequisites['broken_games'][1], '5x'); ?>
								</div>
								<div class="col-xs-9 text-right">
									<div class="huge"><?php echo Games::getGamesBrokenCount(); ?></div>
									<div><?php echo gettext('notworking'); ?></div>
								</div>
							</div>
						</div>
						<a href="<?php echo SITE_URL_ADMIN; ?>index.php?act=media&mthd=viewbroken">
							<div class="panel-footer">
								<span class="pull-left"><?php echo gettext('viewdetails'); ?>></span>
								<span class="pull-right"><?php echo Core::showGlyph('arrow-circle-right'); ?></span>
								<div class="clearfix"></div>
							</div>
						</a>
					</div>
				</div><?php
            }

            /* Inactive Block */
            if (Games::getGamesInactiveCount() > 0) {
                ?>
				<div class="col-lg-2 col-md-6">
					<div class="panel panel-<?php echo $prerequisites['inactive_games'][0]; ?>">
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-3">
									<?php echo Core::showGlyph($prerequisites['inactive_games'][1], '5x'); ?>
								</div>
								<div class="col-xs-9 text-right">
									<div class="huge"><?php echo Games::getGamesInactiveCount(); ?></div>
									<div><?php echo gettext('inactivegames'); ?></div>
								</div>
							</div>
						</div>
						<a href="<?php echo SITE_URL_ADMIN; ?>index.php?act=media&mthd=inactive">
							<div class="panel-footer">
								<span class="pull-left"><?php echo gettext('viewdetails'); ?></span>
								<span class="pull-right"><?php echo Core::showGlyph('arrow-circle-right'); ?></i></span>
								<div class="clearfix"></div>
							</div>
						</a>
					</div>
				</div><?php
            }

            /* SSL Block */
            if (Administrations::getScheme() === 'http://') {
                ?>
				<div class="col-lg-2 col-md-6">
					<div class="panel panel-<?php echo $prerequisites['ssl'][0]; ?>">
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-3">
									<?php echo Core::showGlyph($prerequisites['ssl'][1], '5x'); ?>
								</div>
								<div class="col-xs-9 text-right">
									<div class="huge"><?php echo gettext('ssl'); ?></div>
								</div>
							</div>
						</div>
						<a href="https://www.cloudflare.com/plans" target="_blank">
							<div class="panel-footer">
								<span class="pull-left"><?php echo gettext('viewdetails'); ?></span>
								<span class="pull-right"><?php echo Core::showGlyph('arrow-circle-right'); ?></span>
								<div class="clearfix"></div>
							</div>
						</a>
					</div>
				</div><?php
            }

            /* Session Block */
            if ($prerequisites['folder_session'][0] === 'red') {
                ?>
				<div class="col-lg-2 col-md-6">
					<div class="panel panel-<?php echo $prerequisites['folder_session'][0]; ?>">
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-3">
									<?php echo Core::showGlyph($prerequisites['folder_session'][1], '5x'); ?>
								</div>
								<div class="col-xs-9 text-right">
									<div class="huge"><?php echo gettext('sessions'); ?></div>
									<div><?php echo session_save_path() . ' ' . gettext('unwritable'); ?> </div>
								</div>
							</div>
						</div>
						<div class="panel-footer">
							<p><?php echo gettext('solutionchown'); ?>:</p>
							<p>
								<code>
									$(which chown) -R <?php echo get_current_user(); ?>:<?php echo $processUser['name'] .
                                                                                                   ' ' . session_save_path(); ?>
								</code>
							</p>
							<p><?php echo gettext('solutionchownwarning'); ?></p>
						</div>
						<div class="clearfix"></div>
					</div>
				</div><?php
            } ?>
			<div class="col-lg-2">
				<div class="panel panel-default">
					<div class="panel-heading">
						<?php echo gettext('statistics'); ?>
					</div>
					<div class="panel-body">
						<p class="text-info">
							<?php echo gettext('tg'); ?>: <?php echo number_format(Games::getGamesCount('all')); ?>
						</p>
						<p class="text-info">
							<?php echo gettext('totalgameplays'); ?>: <?php echo number_format(Core::getPlayCountTotal()); ?>
						</p>
						<p class="text-info">
							<?php echo gettext('registeredusers'); ?>: <?php echo number_format(Users::getUsersCount()); ?>
						</p>
					</div>
				</div>
			</div><?php
            break;
        case 'logout':
            Users::userSessionEnd();
            break;
        case 'site-config':
            ?>
			<form action="<?php echo SITE_URL_ADMIN; ?>index.php" method="POST" enctype="multipart/form-data">
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php echo Core::showGlyph('cogs');?>&nbsp;<?php echo gettext('configuration'); ?>
                        </div>
                        <div class="panel-body">
                            <div class="form-group col-md-10">
                                <label><?php echo gettext('sitetitle'); ?></label>
                                <input class="form-control" title="Site Title" name='sitetitle'
                                       value='<?php echo $dbconfig['sitetitle']; ?>'/>
                            </div>
                            <hr/>
                            <div class="form-group col-md-10">
                                <label><?php echo gettext('metadescription'); ?></label>
                                <textarea class="form-control" title="Metadescription" name='metadesc'
                                          rows='6'><?php echo $dbconfig['metadesc']; ?></textarea>
                            </div>
                            <hr/>
                            <div class="form-group col-md-10">
                                <label><?php echo gettext('imgurl'); ?></label>
                                <input class="form-control" title="Image URL" name='imgurl'
                                       value='<?php echo $dbconfig['imgurl']; ?>'/>
                                <p class="help-block"><?php echo gettext('trailingslash') . gettext('imgurlexample'); ?></p>
                            </div>
                        </div>
                        <div class="panel-footer">&nbsp;</div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php echo Core::showGlyph('envelope');?>&nbsp;<?php echo gettext('email'); ?>
                            <p class="help-block pull-right"><?php echo gettext('google_appsforbusiness');?></p>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label><?php echo gettext('emaildomain'); ?></label>
                                <input class="form-control" title="email domain" name='emaildomain'
                                       value='<?php echo $dbconfig['emaildomain']; ?>'/>
                                <p class="help-block"><?php echo gettext('domainhelper'); ?></p>
                            </div>
                            <div class="form-group">
                                <label><?php echo gettext('emailhost'); ?></label>
                                <input class="form-control" title="email host" name='emailhost'
                                       value='<?php echo $dbconfig['emailhost']; ?>'/>
                                <p class="help-block"><?php echo gettext('emailhostexample'); ?></p>
                            </div>
                            <div class="form-group">
                                <label><?php echo gettext('emailport'); ?>
                                    <input class="form-control" title="email port" name='emailport'
                                           value='<?php echo $dbconfig['emailport']; ?>'/>
                                </label>
                                <p class="help-block"><?php echo gettext('emailportexample'); ?></p>
                            </div>
                            <div class="form-group">
                                <label><?php echo gettext('emaildebug'); ?></label>
                                <select class="form-control" title="Email Debug" name="emaildebug"><?php
                                    switch ($dbconfig['emaildebug']) {
                                        case 0:?>
                                            <option value='0' selected>0</option>
                                            <option value='1'>1</option>
                                            <option value='2'>2</option><?php
                                            break;
                                        case 1:?>
                                            <option value='0'>0</option>
                                            <option value='1' selected>1</option>
                                            <option value='2'>2</option><?php
                                            break;
                                        case 2:?>
                                            <option value='0'>0</option>
                                            <option value='1'>1</option>
                                            <option value='2' selected>2</option><?php
                                            break;
                                        default:?>
                                            <option value='ERR' selected>ERROR</option>
                                            <option value='0'>0</option>
                                            <option value='1'>1</option>
                                            <option value='2'>2</option><?php
                                    } ?>
                                </select>
    							<p class="help-block"><?php echo gettext('emaildebugexample'); ?></p>
                            </div>
                        </div>
                        <div class="panel-footer">&nbsp;</div>
                    </div>
                    <input type='hidden' name='act' value='site'/>
                    <input type='hidden' name='mthd' value='site-config-do'/>
                    <?php Pages::getSubmitButton(); ?>
                </div>
            </form><?php
            break;
        case 'site-config-do':
            Administrations::updateConfig('emaildomain', $_POST['emaildomain']);
            Administrations::updateConfig('emailhost', $_POST['emailhost']);
            Administrations::updateConfig('emaildebug', $_POST['emaildebug']);
            Administrations::updateConfig('emailport', $_POST['emailport']);
            Administrations::updateConfig('imgurl', $_POST['imgurl']);
            Administrations::updateConfig('metadesc', $_POST['metadesc']);
            Administrations::updateConfig('sitetitle', $_POST['sitetitle']);
            Core::showSuccess(gettext('updatesuccess'));
            break;
        case 'theme-config': ?>
			<form action="<?php echo SITE_URL_ADMIN; ?>index.php" method="POST" enctype="multipart/form-data">
				<div class="col-lg-4">
					<div class="panel panel-default">
						<div class="panel-heading">
							<?php echo gettext('theme'); ?>
						</div>
						<div class="panel-body">
							<div class="form-group">
								<label><?php echo gettext('theme'); ?>:</label>
								<select class="form-control" title="Theme Name" name="themename">
									<?php $currenttheme = $dbconfig['theme']; ?>
									<option value='<?php echo $currenttheme; ?>'><?php echo $currenttheme; ?></option>
									<?php $dh = opendir(INST_DIR . 'plugins/site/themes/');
                                    while (($filename = readdir($dh)) !== false) {
                                        if (is_dir(INST_DIR . 'plugins/site/themes/' . $filename)) {
                                            $files[] = $filename;
                                        }
                                    }
                                    sort($files);
                                    $arr = [];
                                    foreach ($files as $file) {
                                        if ($file == '.' || $file == '..' || $file == 'admin') {
                                            continue;
                                        }
                                        if ($file[0] != '~') {
                                            $arr[] = $file;
                                        }
                                    }
                                    foreach ($arr as $opt) {
                                        echo "<option value='" . $opt . "'>" . $opt . '</option>';
                                    } ?>
								</select>
								<p class="help-block"><?php echo gettext('uploadthemesto');?> <?php echo gettext('themehelp');?></p>
							</div>
						</div>
						<div class="panel-footer">&nbsp;</div>
					</div>
					<input type='hidden' name='act' value='site'/>
					<input type='hidden' name='mthd' value='theme-config-do'/>
					<?php Pages::getSubmitButton(); ?>
				</div>
			</form><?php
            break;
        case 'theme-config-do':
            Administrations::updateConfig('themename', $_POST['themename']);
            Core::showSuccess(gettext('updatesuccess'));
            break;
        case 'feature-config':
            $checkeddisqus = ($dbconfig['disqus_on'] === 'on') ? 'checked' : "";
            $checkedemailact = ($dbconfig['emailactivation'] === 'on') ? 'checked' : "";
            $checkedfacebk = ($dbconfig['facebook_on'] === 'on') ? 'checked' : "";
            $checkedfeed = ($dbconfig['rssenabled'] === 'on') ? 'checked' : "";
            $checkedgaon = ($dbconfig['ga_enabled'] === 'on') ? 'checked' : "";
            $checkedhsenable = ($dbconfig['highscoresenabled'] === 'on') ? 'checked' : "";
            $checkedpassrecovery = ($dbconfig['passwordrecovery'] === 'on') ? 'checked' : "";
            $checkeduserson = ($dbconfig['membersenabled'] === 'on') ? 'checked' : "";
            ?>
			<form action="<?php echo SITE_URL_ADMIN; ?>index.php" method="POST" enctype="multipart/form-data">
				<div class="col-md-7">
					<div class="panel panel-default">
						<div class="panel-heading">
							<?php echo Core::showGlyph('comments');?>&nbsp;<?php echo gettext('disqus'); ?>
						</div>
						<div class="panel-body">
							<div class="form-group">
								<div class="row">
									<div class="col-md-8">
										<?php echo Core::showGlyph('commenting-o');?>
										<label><?php echo gettext('disqus_enabled'); ?></label>
										<div class="checkbox-inline pull-right">
											<label for="disqus_on"></label>
											<input type="checkbox" name="disqus_on" id="disqus_on" <?php echo $checkeddisqus; ?> data-toggle="toggle" data-onstyle="success" data-offstyle="danger"/>
										</div>
									</div>
								</div>
							</div>
							<hr/>
							<div class="form-group">
                                <div class="row">
                                    <div class="col-md-8">
                                        <label><?php echo gettext('disqus_user'); ?></label>
                                        <input class="form-control" title="Disqus User" name='disqus_user'
                                               value='<?php echo $dbconfig['disqus_user']; ?>'/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">&nbsp;</div>
                    </div>
                </div>
				<div class="col-md-7">
					<div class="panel panel-default">
						<div class="panel-heading">
							<?php echo Core::showGlyph('facebook');?>&nbsp;<?php echo gettext('facebook'); ?>
						</div>
						<div class="panel-body">
							<div class="form-group">
								<div class="row">
									<div class="col-md-8">
										<?php echo Core::showGlyph('database');?>
										<label><?php echo gettext('facebook_enabled'); ?></label>
										<div class="checkbox-inline pull-right">
											<label for="facebook_on"></label>
											<input disabled type="checkbox" name="facebook_on" id="facebook_on" <?php echo $checkedfacebk; ?> data-toggle="toggle" data-onstyle="success" data-offstyle="danger"/>
										</div>
									</div>
								</div>
							</div>
							<hr/>
							<div class="form-group">
                                <div class="row">
                                    <div class="col-md-8">
                                        <label><?php echo gettext('facebook_appid'); ?></label>
                                        <input class="form-control" title="Facebook App ID" name='facebook_appid'
                                               value='<?php echo $dbconfig['facebook_appid']; ?>'/>
                                        <p class="help-block"><?php echo gettext('facebook_developers'); ?></p>
                                    </div>
                                </div>
                            </div>
                            <hr/>
							<div class="form-group">
                                <div class="row">
                                    <div class="col-md-8">
                                        <label><?php echo gettext('facebook_pageurl'); ?></label>
                                        <input class="form-control" title="Facebook Page URL" name="facebook_pageurl"
                                               value="<?php echo $dbconfig['facebook_pageurl']; ?>"/>
                                    </div>
                                </div>
                            </div>
						</div>
						<div class="panel-footer">&nbsp;</div>
					</div>
				</div>
				<div class="col-md-7">
					<div class="panel panel-default">
						<div class="panel-heading">
							<?php echo Core::showGlyph('bullseye');?>&nbsp;<?php echo gettext('highscores'); ?>
						</div>
						<div class="panel-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-8">
                                        <?php echo Core::showGlyph('bullseye'); ?>
                                        <label for="highscoresenabled"><?php echo gettext('highscoresenabled'); ?></label>
                                        <div class="pull-right">
                                            <input type="checkbox" name="highscoresenabled" id="highscoresenabled" <?php echo $checkedhsenable; ?> data-toggle="toggle" data-onstyle="success" data-offstyle="danger"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
						</div>
						<div class="panel-footer">&nbsp;</div>
					</div>
				</div>
				<div class="col-md-7">
					<div class="panel panel-default">
						<div class="panel-heading">
							<?php echo Core::showGlyph('google');?>&nbsp;<?php echo gettext('google'); ?>
						</div>
						<div class="panel-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-8">
                                        <?php echo Core::showGlyph('google');?>&nbsp;
                                        <label><?php echo gettext('ga_enabled'); ?></label>
                                        <div class="pull-right">
                                            <label for="ga_enabled"></label>
                                            <input type="checkbox" name="ga_enabled" id="ga_enabled" <?php echo $checkedgaon; ?> data-toggle="toggle" data-onstyle="success" data-offstyle="danger"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-8">
                                        <label><?php echo gettext('ga_id'); ?></label>
                                        <input class="form-control" title="Google Analytics Code" name='ga_id'
                                               value='<?php echo $dbconfig['ga_id']; ?>'/>
                                    </div>
                                </div>
                            </div>
                            <hr/>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-8">
                                        <?php echo Core::showGlyph('database');?>
                                        <label><?php echo gettext('google_recaptcha_sitekey'); ?></label>
                                        <input class="form-control" title="<?php echo gettext('google_recaptcha_sitekey');?>"
                                               name='google_recaptcha_sitekey'
                                               value='<?php echo $dbconfig['google_recaptcha_sitekey']; ?>'/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-8">
                                        <label><?php echo gettext('google_recaptcha_secretkey'); ?></label>
                                        <input class="form-control" title="<?php echo gettext('google_recaptcha_secretkey');?>"
                                               name='google_recaptcha_secretkey'
                                               value='<?php echo $dbconfig['google_recaptcha_secretkey']; ?>'/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">&nbsp;</div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php echo gettext('thumbnails'); ?>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-8">
                                        <label><?php echo gettext('width'); ?></label>
                                        <input class="form-control" title="Thumbnail Width" name='twidth'
                                               value='<?php echo $dbconfig['twidth']; ?>'/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-8">
                                        <label><?php echo gettext('height'); ?></label>
                                        <input class="form-control" title="Thumbnail Height" name='theight'
                                               value='<?php echo $dbconfig['theight']; ?>'/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">&nbsp;</div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php echo gettext('mediafiles'); ?>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-8">
                                        <label><?php echo gettext('defaultwidth'); ?></label>
                                        <input class="form-control" title="Default Game Width" name='defgwidth'
                                               value='<?php echo $dbconfig['defgwidth']; ?>'/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-8">
                                        <label><?php echo gettext('defaultheight'); ?></label>
                                        <input class="form-control" title="Default Game Height" name='defgheight'
                                               value='<?php echo $dbconfig['defgheight']; ?>'/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">&nbsp;</div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php echo gettext('rssfeeds'); ?>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-8">
                                        <?php echo Core::showGlyph('rss');?>
                                        <label><?php echo gettext('enablerss'); ?></label>
                                        <div class="checkbox-inline pull-right">
                                            <input type="checkbox" name="rssenabled" title="rssenabled" id="rssenabled" <?php echo $checkedfeed;?> data-toggle="toggle" data-onstyle="success" data-offstyle="danger"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-8">
                                        <?php echo Core::showGlyph('asterisk');?>
                                        <label><?php echo gettext('numlatest'); ?></label>
                                        <input class="form-control" name='rssnumlatest' title="rssnumlatest"
                                               value='<?php echo $dbconfig['rssnumlatest']; ?>'/>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-8">
                                        <?php echo Core::showGlyph('link');?>
                                        <label><?php echo gettext('rssfeedurl'); ?></label>
                                        <input class="form-control" name='rssfeed' title="rssfeed"
                                               value='<?php echo $dbconfig['rssfeed']; ?>'/>
                                        <p class="help-block"><?php echo gettext('rssfeedexample1'); ?></p>
                                        <p class="help-block"><?php echo gettext('rssfeedexample2'); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">&nbsp;</div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php echo Core::showGlyph('envelope');?>&nbsp;<?php echo gettext('general'); ?>
                            <p class="help-block pull-right"><?php echo gettext('google_appsforbusiness');?></p>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-8">
                                        <?php echo Core::showGlyph('users');?>
                                        <label><?php echo gettext('usersenabled'); ?></label>
                                        <div class="checkbox-inline pull-right">
                                            <label for="membersenabled"></label>
                                            <input type="checkbox" name="membersenabled" id="membersenabled" <?php echo $checkeduserson; ?> data-toggle="toggle" data-onstyle="success" data-offstyle="danger"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-8">
                                        <?php echo Core::showGlyph('list');?>
                                        <label><?php echo gettext('emailactivation'); ?></label>
                                        <div class="checkbox-inline pull-right">
                                            <label for="emailactivation"></label>
                                            <input type="checkbox" name="emailactivation" id="emailactivation" <?php echo $checkedemailact; ?> data-toggle="toggle" data-onstyle="success" data-offstyle="danger"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-8">
                                        <?php echo Core::showGlyph('list');?>
                                        <label><?php echo gettext('allowpasswordrecovery'); ?></label>
                                        <div class="checkbox-inline pull-right">
                                            <label for="passwordrecovery"></label>
                                            <input type="checkbox" name="passwordrecovery" id="passwordrecovery" <?php echo $checkedpassrecovery; ?> data-toggle="toggle" data-onstyle="success" data-offstyle="danger"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-8">
                                        <label>
                                            <?php echo gettext('emailaddressfrom'); ?>
                                            <input class="form-control" name='emailfrom' value='<?php echo $dbconfig['emailfrom']; ?>'/>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <input type='hidden' name='act' value='site' />
                            <input type='hidden' name='mthd' value='feature-config-do' />
                            <?php Pages::getSubmitButton(); ?>
                        </div>
                    </div>
                </div>
			</form><?php
            break;
        case 'feature-config-do':
            Administrations::updateConfig('defgwidth', $_POST['defgwidth']);
            Administrations::updateConfig('defgheight', $_POST['defgheight']);
            Administrations::updateConfig('disqus_on', array_key_exists('disqus_on', $_POST) ? 'on' : 'off');
            Administrations::updateConfig('disqus_user', $_POST['disqus_user']);
            Administrations::updateConfig('emailactivation', array_key_exists('emailactivation', $_POST) ? 'on' : 'off');
            Administrations::updateConfig('emailfrom', $_POST['emailfrom']);
            Administrations::updateConfig('facebook_appid', $_POST['facebook_appid']);
            Administrations::updateConfig('facebook_pageurl', $_POST['facebook_pageurl']);
            Administrations::updateConfig('facebook_on', array_key_exists('facebook_on', $_POST) ? 'on' : 'off');
            Administrations::updateConfig('ga_enabled', array_key_exists('ga_enabled', $_POST) ? 'on' : 'off');
            Administrations::updateConfig('ga_id', $_POST['ga_id']);
            Administrations::updateConfig('google_recaptcha_secretkey', $_POST['google_recaptcha_secretkey']);
            Administrations::updateConfig('google_recaptcha_sitekey', $_POST['google_recaptcha_sitekey']);
            Administrations::updateConfig('highscoresenabled', array_key_exists('highscoresenabled', $_POST) ? 'on' : 'off');
            Administrations::updateConfig('membersenabled', array_key_exists('membersenabled', $_POST) ? 'on' : 'off');
            Administrations::updateConfig('passwordrecovery', array_key_exists('passwordrecovery', $_POST) ? 'on' : 'off');
            Administrations::updateConfig('rssenabled', array_key_exists('rssenabled', $_POST) ? 'on' : 'off');
            Administrations::updateConfig('rssfeed', $_POST['rssfeed']);
            Administrations::updateConfig('rssnumlatest', $_POST['rssnumlatest']);
            Administrations::updateConfig('twidth', $_POST['twidth']);
            Administrations::updateConfig('theight', $_POST['theight']);
            Core::showSuccess(gettext('updatesuccess'));
            break;
        default:
    }
    unset($prerequisites);
} ?>