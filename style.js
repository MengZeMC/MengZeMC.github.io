// 为整个页面添加点击特效
document.addEventListener('click', function(e) {
  const clickEffect = document.createElement('div');
  clickEffect.className = 'click-effect';
  clickEffect.style.left = e.pageX + 'px'; // 使用pageX获取相对于文档左上角的水平位置
  clickEffect.style.top = e.pageY + 'px'; // 使用pageY获取相对于文档左上角的垂直位置

  const text = document.createElement('span'); // 创建包含特定文字的<span>元素
  text.className = 'click-effect-text';
  text.textContent = '欢迎'; // 替换为您想要显示的特定文字内容

  clickEffect.appendChild(text); // 将特定文字添加到点击特效中
  document.body.appendChild(clickEffect);

  setTimeout(() => {
    clickEffect.remove();
  }, 1000);
});
