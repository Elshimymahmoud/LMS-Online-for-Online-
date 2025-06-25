<?php

namespace App\Notifications\Frontend;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class GroupChatNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($group)
    {
        $this->group = $group;
        $this->course = $group->courses;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
     //   return (new MailMessage)
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message' => __('strings.notifications.course.new_message'),
            'url' => route('courses.details', ['course_slug' => $this->course->slug, 'group' => $this->group->id]),
        ];
    }
}
