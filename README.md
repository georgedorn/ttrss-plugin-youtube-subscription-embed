# ttrss-plugin-youtube-subscription-embed
Converts a gdata.youtube.com feed from images to embedded videos.

If you have an RSS feed of your youtube subscriptions, such as:

http://gdata.youtube.com/feeds/base/users/USERNAME/newsubscriptionvideos?start-index=1&max-results=25

The resulting items will have video stills and descriptions of the video.  This plugin converts the video still into an embedded videoplayer (inside an iframe) so you can watch it within the feed.

Bits of code borrowed from the videoframes plugin (https://github.com/tribut/ttrss-videoframes), specifically generating the iframe itself.  Thanks @tribut.

## Installation

Like most plugins, it has to go in /plugins, and it has to have a specific dirname.  To get this:

```
cd /path/to/ttrss/
git clone https://github.com/georgedorn/ttrss-plugin-youtube-subscription-embed.git plugins/youtube_gdata
```

Then go enable it in your preferences.  No settings required.  May explode if you enable the no_iframes plugin, I dunno.
