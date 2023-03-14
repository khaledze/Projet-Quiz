const buttons = document.querySelectorAll('button');

buttons.forEach((button) => {
  button.addEventListener('mouseover', () => {
    button.style.backgroundColor = '#555';
    button.style.color = '#fff';
  });

  button.addEventListener('mouseout', () => {
    button.style.backgroundColor = '#333';
    button.style.color = '#fff';
  });
});
