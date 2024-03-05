import Vue from 'vue';

export default ({title ='Error', errors={}}) => {
  const listErrors = Object.keys(errors).map((key) => `<li>${errors[key]}</li>`).join('');
  console.log(listErrors);
  Vue.notify({
    group: 'custom-notification',
    title: title,
    text: `<ul>${listErrors}</ul>`,
    type: 'error'
  });
};
