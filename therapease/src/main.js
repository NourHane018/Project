import '../styles/modern-normalize.css'
import '../styles/style.css'
import '../styles/utils.css'
import '../styles/components/header.css'
import '../styles/components/hero.css'
import '../styles/components/About.css'
import '../styles/components/Service.css'
import '../styles/components/Doctor.css'
import '../styles/components/Contact.css'
import '../styles/components/footer.css'
import '../styles/components/mobile_nav.css'
import i18next from 'i18next';
import HttpBackend from 'i18next-http-backend';

const userLanguage = window.navigator.language || window.navigator.userLanguage;
const defaultLanguage = userLanguage.startsWith('ar') ? 'ar' : 'en';

i18next
  .use(HttpBackend)
  .init({
    lng: defaultLanguage,
    fallbackLng: 'en',
    backend: {
      loadPath: '/src/locales/{{lng}}.json' 
    }
  }, (err, t) => {
    if (err) return console.error(err);

    //Home 
    
    document.querySelector('.header__link[href="#hero"]').textContent = t('Home');
    document.querySelector('.header__link[href="#About"]').textContent = t('About');
    document.querySelector('.header__link[href="#Servisec"]').textContent = t('Services');
    document.querySelector('.header__link[href="#Doctor"]').textContent = t('Doctor');
    document.querySelector('.header__link[href="#Contact"]').textContent = t('Contact');
	document.getElementById('hero__title1').innerHTML = t('Al-Safa Clinic');
    document.getElementById('hero__title2').innerHTML = t('Welcome');
    document.getElementById('output').innerHTML = t('to') + ' <br/>' + t('TherapEase!');
    document.querySelector('.btn').textContent = t('join us');
    document.querySelector('.Make').textContent = t('Make everything easy');
    document.querySelector('.hero__description').textContent = t(' We provide specialized services to improve speech and language.')+ "		" + t(" including speech rehabilitation sessions and speech therapy guidance for the general public. Whether you're experiencing speech and language disorders or seeking support in this area, we're here to help. Feel free to browse our website for more information.")
	;
	// About
	document.querySelector('.title').textContent = t('Speech therapy');
	document.querySelector('.About__description').textContent = t("Speech therapy treats language, speech, and voice disorders across all ages, drawing from disciplines like psychology, sociology, medicine, pedagogy, and linguistics. Speech-language pathologists need intelligence, self-confidence, and effective communication skills. They address various disorders, including delayed speech, language delay, articulation disorders, autism, Asperger's syndrome, Down syndrome, dyslexia, dyscalculia, hearing impairments, brain injuries, aphasia, voice production disorders, psychiatric disorders, and intellectual disabilities in neurodegenerative diseases like Alzheimer's and Parkinson's.");

	//Services
	document.querySelector('.services__title').textContent = t('Our services');
	document.getElementById('provide_intro').textContent = t('We provide');
    document.getElementById('distinctive').textContent = t('distinctive and wonderful');
    document.getElementById('services').textContent = t('services that meet your needs and help you achieve your goals');
    document.getElementById('1').textContent = t('Addressing speech disorders');
    document.getElementById('2').textContent = t('Addressing language disorders');
    document.getElementById('3').textContent = t('Assisting with delayed speech');
    document.getElementById('4').textContent = t('Treating voice disorders');
    document.getElementById('5').textContent = t('Supporting individuals with learning difficulties');
    document.getElementById('6').textContent = t('Helping individuals with Down syndrome');
    document.getElementById('7').textContent = t('Providing therapy for autism');
    document.getElementById('8').textContent = t('Treating aphasia');
    document.getElementById('9').textContent = t("Assisting individuals with developmental disorders (Alzheimer's, Parkinson's)");




    //Doctor
	document.querySelector('.Doctor-info').textContent = t("Doctor's information");
	document.querySelector('.doctor-name').textContent = t("DR.Safia Selmani");
	document.getElementById('d_info').textContent= t("A graduate from El-Hajj Lakhdar University in Batna 1 holds a bachelor's degree in speech therapy and a master's degree in speech and communication disorders. She has obtained several other certificates in the fields of speech therapy and allied health. With 3 years of experience in the field, she owns the 'Safaa Speech Therapy Clinic.'");

	//contact
	document.getElementById('Contact_us').textContent= t('Contact us');
	document.getElementById('want_to_join').textContent= t('Want to join us ?');
	document.getElementById('join_N').textContent= t('JOIN NOW');
	document.getElementById('clinic_A').textContent= t('Clinic address:');
	document.getElementById('address').textContent= t('Sefiane Municipality, Naqaos District, Batna Province.');
	document.getElementById('phone').textContent= t('Call for query');
	document.getElementById('email').textContent= t('Mail us for help!');
  });

  
import MobileNav from './utils/mobile_nav'
MobileNav();

$(function() {

	"use strict";

	$(".section-contact .content .hire-us button").on("mouseenter", function() {
		$(this).parent().css("backgroundColor","#5dadc4");
		$(this).css({
			"background-color": "#252525",
			"box-shadow": "0 0 5px 0 rgba(0,0,0,.8)"
		});
	});

	$(".section-contact .content .hire-us button").on("mouseleave", function() {
		$(this).parent().css("backgroundColor","#252525");
		$(this).css({
			"background-color": "#5dadc4",
			"box-shadow": "none"
		});
	});

});