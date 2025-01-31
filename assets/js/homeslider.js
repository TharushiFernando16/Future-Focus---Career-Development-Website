const images = [
  'assets/images/frontbackground1.jpg',
 'assets/images/frontbackground2.jpg',
  'assets/images/frontbackground3.jpg',
  'assets/images/frontbackground4.jpg',
  'assets/images/frontbackground5.jpg',
  'assets/images/frontbackground6.jpg',
 'assets/images/frontbackground7.jpg',
  'assets/images/frontbackground8.jpg',
  'assets/images/frontbackground9.jpg',
  'assets/images/frontbackground10.jpg'
];
  
  let index = 0;
  const section = document.getElementById('home-section');
  
  
  section.classList.add('default-bg');
  


function changeBackground() {
  section.style.backgroundImage = `url('${images[index]}')`;
  section.classList.remove('default-bg'); 
  
  
  if (index === 0) {
    section.style.backgroundPosition = 'center';  
    section.style.backgroundSize = 'cover';      
    section.style.opacity = '1.9';                 
  } else if (index === 1) {
    section.style.backgroundPosition = 'center'; 
    section.style.backgroundSize = 'cover';         
    section.style.opacity = '1.8';                
  } else if (index === 2) {
    section.style.backgroundPosition = 'center'; 
    section.style.backgroundSize = 'cover';          
    section.style.opacity = '1.8';                     
  } else if (index === 3) {
    section.style.backgroundPosition = 'center'; 
    section.style.backgroundSize = 'cover';      
    section.style.opacity = '1.8';                 
  } else if (index === 4) {
    section.style.backgroundPosition = 'center'; 
    section.style.backgroundSize = 'cover';         
    section.style.opacity = '1.8';                
  } else if (index === 5) {
    section.style.backgroundPosition = 'center'; 
    section.style.backgroundSize = 'cover';          
    section.style.opacity = '1.8';                     
  } else if (index === 6) {
    section.style.backgroundPosition = 'center'; 
    section.style.backgroundSize = 'cover';      
    section.style.opacity = '1.8'; 
  } else if (index === 7) {
    section.style.backgroundPosition = 'center'; 
    section.style.backgroundSize = 'cover';          
    section.style.opacity = '1.8';                     
  } else if (index === 8) {
    section.style.backgroundPosition = 'center'; 
    section.style.backgroundSize = 'cover';      
    section.style.opacity = '1.8'; 
  } else {
    section.style.backgroundPosition = 'center'; 
    section.style.backgroundSize = 'cover';           
    section.style.opacity = '1.8';                  
  }
  
  index = (index + 1) % images.length;
}


setInterval(changeBackground, 5000);