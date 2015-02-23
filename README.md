# ttrss-plugin-youtube-subscription-embed
Converts a gdata.youtube.com feed from images to embedded videos.

If you have an RSS feed of your youtube subscriptions, such as:

http://gdata.youtube.com/feeds/base/users/USERNAME/newsubscriptionvideos?start-index=1&max-results=25

The resulting items will have video stills and descriptions of the video.  This plugin converts the video still into an embedded videoplayer (inside an iframe) so you can watch it within the feed.

Bits of code borrowed from the videoframes plugin (https://github.com/tribut/ttrss-videoframes), specifically generating the iframe itself.  Thanks @tribut.
