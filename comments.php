<?php
 
// ########## Не удаляйте данные стоки
if (isset($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])){
 die ('Please do not load this page directly. Thanks!'); }
if ( post_password_required() ) { ?>
 <p class="nocomments"><?php _e('Этот пост защищен паролем. Введите пароль для просмотра комментариев.', 'kubrick'); ?></p>
<?php
 return; }
// ########## Конец секции
 
// Отображение комментариев
if ( have_comments() ) : ?>
 <h4 id="comments"><?php comments_number('Нет комментариев', 'Один комментарий', '% Комментариев');?> <?php printf('для “%s”', the_title('', '', false)); ?></h4>
 <div class="navigation">
 <div class="alignleft"><?php previous_comments_link() ?></div>
 <div class="alignright"><?php next_comments_link() ?></div>
 </div>
 <ol class="commentlist">
 <?php
 wp_list_comments(array(
 // see http://codex.wordpress.org/Function_Reference/wp_list_comments
 // 'login_text' => 'Login to reply',
 // 'callback' => null,
 // 'end-callback' => null,
 // 'type' => 'all',
 // 'avatar_size' => 32,
 // 'reverse_top_level' => null,
 // 'reverse_children' =>
 ));
 ?>
 </ol>
 <div class="navigation">
 <div class="alignleft"><?php previous_comments_link() ?></div>
 <div class="alignright"><?php next_comments_link() ?></div>
 </div>
 <?php
 if ( ! comments_open() ) : // There are comments but comments are now closed
 echo"<p class='nocomments'>Комментарии закрыты.</p>";
 endif;
 
else : // I.E. There are no Comments
 if ( comments_open() ) : // Comments are open, but there are none yet
 // echo"<p>Be the first to write a comment.</p>";
 else : // comments are closed
 echo"<p class='nocomments'>Комментарии закрыты.</p>";
 endif;
endif;
 
comment_form(array(
 // see codex http://codex.wordpress.org/Function_Reference/comment_form for default values
 // tutorial here http://blogaliving.com/wordpress-adding-comment_form-theme/
 'comment_field' => '<p><textarea style="height:130px; width:auto;" name="comment" id="comment" cols="58" rows="10" tabindex="4" aria-required="true"></textarea></p>',
 'label_submit' => 'Отправить',
 'comment_notes_after' => ''
 ));
 
?>