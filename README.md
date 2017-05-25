### PHP image optimiser
Utilising [dropzonejs](http://dropzonejs.com) and [ImageMagik](http://php.net/manual/en/book.imagick.php) a simple php solution to be able to easily optimise images

The use case of this was to be able to easily optimise images before uploading them to a website, to make sure they are small and snappy. Generated images for the website were ~3mb in size, and the website makes heavy use of images (e-commerce store) so having lots of large images isn't ideal. I was manually doing the optimisation, but figured if I made something I could host somewhere, the content editor could resize the images themselves!

This is really adapted to my needs. Images are always coming at the same size dimension and format
What I am doing to the images:
1. Resizing image to specified size (squared)
2. Striping the image of any meta data
3. Converting to JPEG
4. setting quality of output to 85%
5. Making the image a [progressive jpeg](https://optimus.keycdn.com/support/progressive-jpeg/)

Doing these things is optimising the images from ~3mb in size down to 132kb (resizing to 1024x1024) and 37kb (resize to 512x512)

### Installing
- You will obviously need php, and php Imagick.
- Ensure you have updated your upload limits in php.ini or .htaccess to allow for larger files