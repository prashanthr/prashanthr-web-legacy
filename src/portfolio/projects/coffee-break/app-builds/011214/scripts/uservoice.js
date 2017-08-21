/* uservoice.js */

// <!-- UserVoice JavaScript SDK (only needed once on a page) -->
(function(){var uv=document.createElement('script');uv.type='text/javascript';uv.async=true;uv.src='//widget.uservoice.com/HH2YuQkz7slynrluECg4w.js';var s=document.getElementsByTagName('script')[0];s.parentNode.insertBefore(uv,s)})()

// <!-- A tab to launch the Classic Widget -->
UserVoice = window.UserVoice || [];
UserVoice.push(['showTab', 'classic_widget', {
  mode: 'full',
  primary_color: '#ab4700',
  link_color: '#007dbf',
  default_mode: 'feedback',
  forum_id: 212929,
  support_tab_name: 'Contact Prashanth',
  tab_label: 'Got Ideas?',
  tab_color: '#ab4700',
  tab_position: 'middle-right',
  tab_inverted: false
}]);