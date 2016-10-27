<?php
namespace Zurtr\OneSignal\Listener;

use Flarum\Event\NotificationWillBeSent;
use Flarum\Settings\SettingsRepositoryInterface;
use Illuminate\Contracts\Events\Dispatcher;
use Zurtr\OneSignal\OneSignalAPI;
use Flarum\Foundation\Application;

class SendWebPushNotification
{

	protected  $oneSignalAPI;
	protected  $settings;
	protected $applicationBaseURL;

	public function __construct(SettingsRepositoryInterface $settings, Application $application)
	{
		$this->settings = $settings;
		$this->applicationBaseURL = $application->config('url');
		$this->oneSignalAPI = new OneSignalAPI($this->settings->get('zurtr-onesignal.one_signal_app_id'));
	}


	public function subscribe(Dispatcher $events)
	{
		$events->listen(NotificationWillBeSent::class, [$this, 'sendWebPushNotification']);
	}


	public function sendWebPushNotification(NotificationWillBeSent $event)
	{
		 
		$notificationEvent = $event->blueprint;
		$subjectModel = $notificationEvent->getSubjectModel();

		$subject = $notificationEvent->getSubject();
		if($subject == null)
			return ;
			$receiverUser = $subject->user;
			if($receiverUser == null || $receiverUser->one_signal_user_id == null)
				return ;
				$notificationType = $notificationEvent->getType();

				$senderUser = $notificationEvent->getSender();
				$postComment =  substr(strip_tags($subject->content), 0, 50);
				switch ($notificationType){
					case 'postLiked':
						$message = $senderUser->username . ' liked your comment "' . $postComment .'"';
						$heading = $senderUser->username . ' liked your post';
						$link =  $this->applicationBaseURL . '/d/' . $subject->discussion_id;
						break;
					case 'postMentioned':
						$message = $senderUser->username . ' mentioned you in his comment "' . $postComment .'"';;
						$heading = $senderUser->username . ' mentioned you in a post';
						$link =  $this->applicationBaseURL . '/d/' . $subject->discussion_id;
						break;
					default: return;
					break;
				}


				$this->oneSignalAPI->pushNotification($message,
						$receiverUser->one_signal_user_id,
						$link,
						$heading);

	}
}