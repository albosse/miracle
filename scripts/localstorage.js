function confirmDelete()
{
	var answer = confirm("Really delete all stored data?")
	if (answer){
		resetContent();
		return true;
	}
	else{
		return false;
	}
}

if (typeof(localStorage) == 'undefinded' )
{
	alert('Your browser does not support HTML5 localStorage. Try upgrading.');
}

function bookmark(bm)
{
 localStorage.setItem('bookmark', bm);
}
function bookmarkL(bm)
{
 localStorage.setItem('bookmarkL', bm);
}

function getBookmark()
{
 var tmpBm = localStorage.getItem('bookmark');
 if(tmpBm==null)
 {
	tmpBm='index';
 }

 return tmpBm;
}

function getBookmarkL()
{
 var tmpBm = localStorage.getItem('bookmarkL');
 if(tmpBm==null)
 {
	tmpBm='index';
 }
 return tmpBm;
}
function checkIsset(key)
{
 var tmp = localStorage.getItem(key);

 if(typeof(tmp) != "undefined" && tmp !== null)
 {
	return true;
 }
 else
 {
 	return false;
 }
}

function saveCheckValues(form)
{
	var elemente = form.getElementsByTagName("input");
	for (var i = 0; i < elemente.length; i++)
		{
			if (elemente[i].type == "checkbox")
			{
				localStorage.setItem(elemente[i].id, elemente[i].checked);
			}
		}
}

function saveCheckValuesBm(form, bm)
{
	var elemente = form.getElementsByTagName("input");
	for (var i = 0; i < elemente.length; i++)
		{
			if (elemente[i].type == "checkbox")
			{
				localStorage.setItem(elemente[i].id, elemente[i].checked);
			}
		}
	 localStorage.setItem('bookmark', bm);
}

function saveCheckValuesBmL(form, bm)
{
	var elemente = form.getElementsByTagName("input");
	for (var i = 0; i < elemente.length; i++)
		{
			if (elemente[i].type == "checkbox")
			{
				localStorage.setItem(elemente[i].id, elemente[i].checked);
			}
		}
	 localStorage.setItem('bookmarkL', bm);
}



function saveValues(form)
			{
				var types = new Array("input", "select", "text", "textarea");

				for (var j = 0; j < types.length; j++)
				{
					var elemente = form.getElementsByTagName(types[j]);

					for (var i = 0; i < elemente.length; i++)
					{
						switch(elemente[i].type){
						case 'checkbox':
						saveValue(elemente[i].id, elemente[i].checked);
						break;

						default:
						saveValue(elemente[i].id, elemente[i].value);
						}
					}
				}
}

function saveValuesBm(form, bm)
	{
		var types = new Array("input", "select", "text", "textarea", "radio");

		for (var j = 0; j < types.length; j++)
		{
			var elemente = form.getElementsByTagName(types[j]);

			for (var i = 0; i < elemente.length; i++)
			{
				switch(elemente[i].type){
				case 'checkbox':
				saveValue(elemente[i].id, elemente[i].checked);
				break;

				case 'radio':
				saveValue(elemente[i].id, elemente[i].checked);
				break;

				default:
				saveValue(elemente[i].id, elemente[i].value);

				}
			}
		}
	localStorage.setItem('bookmark', bm);
}

function saveValuesBmL(form, bm)
	{
		var types = new Array("input", "select", "text", "textarea", "radio");

		for (var j = 0; j < types.length; j++)
		{
			var elemente = form.getElementsByTagName(types[j]);

			for (var i = 0; i < elemente.length; i++)
			{
				switch(elemente[i].type){
				case 'checkbox':
				saveValue(elemente[i].id, elemente[i].checked);
				break;

				case 'radio':
				saveValue(elemente[i].id, elemente[i].checked);
				break;

				default:
				saveValue(elemente[i].id, elemente[i].value);
				}
			}
		}
	localStorage.setItem('bookmarkL', bm);
}

function saveValueBm(key, value, bm)
{
		localStorage.setItem(key, value);
     localStorage.setItem('bookmark', bm);
}

function saveValueBmL(key, value, bm)
{
	localStorage.setItem(key, value);
     localStorage.setItem('bookmarkL', bm);
}

function saveValue(key, value)
{
		localStorage.setItem(key, value);
}


function resetContent()
{
    localStorage.clear();
    window.location.reload();
}

function getApoBmLink()
{
	var tmpbm = getBookmark();
	tmpbm = "../processes/Apoplex.html#"+tmpbm;
	self.location.href = tmpbm;
}

function getLCPBmLink()
{
	var tmpbm = getBookmarkL();
	if(tmpbm == 'end')
	{
		tmpbm = "../processes/LCP_Report.html#"+tmpbm;
	}else{
		tmpbm = "../processes/LCP.html#"+tmpbm;
	}
	self.location.href = tmpbm;
}

function printLocalStorage()
{
	if(localStorage.length == 0)
	{
		document.write("No data available.");
	}
	 for (i=0; i<=localStorage.length-1; i++)
	 {
	         key = localStorage.key(i);
	         val = localStorage.getItem(key);
	         document.write("Key: ");
	         document.write(key);
   	         document.write("<br />");
	         document.write("Value: ");
	         document.write(val);
	         document.write("<br />");
	         document.write("<br />");
   }
}

function printValueGer(key)
{
	val = localStorage.getItem(key);
	if (val != null)
	{
	if(val == 'false')
	{
	document.write('nein');
	} else
	{
	document.write('ja');
	}
	}
}

function printValueEng(key)
{
	val = localStorage.getItem(key);
	if (val != null)
	{
	if(val == 'false')
	{
	document.write('no');
	} else
	{
	document.write('yes');
	}
	}
}

function printValue(key)
{
	val = localStorage.getItem(key);
	if (val != null)
	{
		document.write(val);
	}
}

function getValueForReport(key)
{
	val = localStorage.getItem(key);

	if (val != null)
	{
		if(val == 'false')
		{
			return 'no';
		}
		else if(val == 'true')
		{
			return 'yes';
		}
		else
		{
			return val;
		}
	}
}


function saveReportLCP()
{
	var content = "Summary\n";
	content += "==============\n\n";
	content += "1. Check Circumstances\n";
	content += "\t1.1 Profoundly weak/essentially bed-bound:" + getValueForReport('form_check_circumstances_s1') + "\n";
	content += "\t1.2 Semi-comatose, drowsy:" + getValueForReport('form_check_circumstances_s2')+ "\n";
	content += "\t1.3 Disinterested in food and fluid:" + getValueForReport('form_check_circumstances_s3')+ "\n";
	content += "\t1.4 Difficulty swallowing:" + getValueForReport('form_check_circumstances_s4')+ "\n";

	content += "\n2. Place of death\n";
	content += "\t2.1 Desired place of death:" + getValueForReport('place_of_death')+ "\n";
	content += "\t2.2 Bed availability:" + getValueForReport('bed_availability')+ "\n";
	content += "\t2.3 Bed  If no beds are available:" + getValueForReport('no_bed_available')+ "\n";

	content += "\n3. Perform Assessment for Symptom Management\n";
	content += "\t3.1 Unable to Swallow:" + getValueForReport('check_need_for_sc_med_s1')+ "\n";
	content += "\t3.2 Intestinal obstruction:" + getValueForReport('check_need_for_sc_med_s2')+ "\n";
	content += "\t3.3 Persistent nausea and vomiting:" + getValueForReport('check_need_for_sc_med_s3')+ "\n";
	content += "\t3.4 Decreased level of consciousness:" + getValueForReport('check_need_for_sc_med_s4')+ "\n";
	content += "\t3.5 Malabsorbtion:" + getValueForReport('check_need_for_sc_med_s4')+ "\n";
	content += "\t3.6 Unsatisfactory response to oral medication:" + getValueForReport('check_need_for_sc_med_s4')+ "\n";

	content += "\n4. Pain Assessment\n";
	content += "\t4.1 Assess Pain:" + getValueForReport('assess_pain')+ "\n";
	content += "\t4.2 Ability to swallow:" + getValueForReport('swallow')+ "\n";
	content += "\t4.3 Liver function:" + getValueForReport('liver')+ "\n";

	content += "\n5. Nausea and vomiting\n";
	content += "\t5.1 Nausea and vomiting:" + getValueForReport('vomiting')+ "\n";

	content += "\n6. Oral assessment\n";
	content += "\t6.1 Oral mucosa:" + getValueForReport('oral_mucosa')+ "\n";

	content += "\n7. Dyspnoea\n";
	content += "\t7.1 Dyspnoea present:" + getValueForReport('dyspnoea')+ "\n";
	content += "\t7.2 Related anxiety:" + getValueForReport('anxiety')+ "\n";
	content += "\t7.3 Clorazepam drops sublingually 0.5 mgs 8-12 hourly:" + getValueForReport('form_related_anxiety_s1')+ "\n";
	content += "\t7.4 Alternative 1: Lorazepam 0.5 mg sublingually 4th hourly PRN:" + getValueForReport('form_related_anxiety_s2')+ "\n";
	content += "\t7.5 Alternative 2: Alprazolam 0.5 mg sublingually 4th hourly PRN:" + getValueForReport('form_related_anxiety_s3')+ "\n";

	content += "\n8. Anxiety or insomnia\n";
	content += "\t8.1 Lorazepam OR Alprazolam 0.5 mg (po/sublingual) q4hourly PRN:" + getValueForReport('check_if_anxiety_or_insomnia_s1')+ "\n";
	content += "\t8.1 Temazepam 10-20mg po nocte PRN:" + getValueForReport('check_if_anxiety_or_insomnia_s2')+ "\n";
	content += "\t8.2 Clonazepam 0.5-2 mg sublingual drops q8hourly PRN:" + getValueForReport('check_if_anxiety_or_insomnia_s3')+ "\n";

	content += "\n9. Constipation\n";
	content += "\t9.1 Constipation:" + getValueForReport('constipation')+ "\n";
	content += "\t9.1 Consider if appropriate to intervene in terminal phase: client experiencing terminal restlessness may be constipated:" + getValueForReport('terminal_phase')+ "\n";

	content += "\n10.Restlessness, agitation, and/or anxiety\n";
	content += "\t10.1 Repositioning:" + getValueForReport('consider_non_pharmacological_ways_s1')+ "\n";
	content += "\t10.2 Assessment for full bladder:" + getValueForReport('consider_non_pharmacological_ways_s2')+ "\n";
	content += "\t10.3 Assessment for constipation:" + getValueForReport('consider_non_pharmacological_ways_s3')+ "\n";
	content += "\t10.4 Client requires constant attention by carers:" + getValueForReport('consider_non_pharmacological_ways_s4')+ "\n";
	content += "\t10.5 Religious/Spiritual support:" + getValueForReport('consider_non_pharmacological_ways_s5')+ "\n";
	content += "\t10.6 Arrange subcutaneos Midazolam:" + getValueForReport('arrange_sc_med_s1')+ "\n";
	content += "\t10.7 Arrange subcutaneos Haloperidol:" + getValueForReport('arrange_sc_med_s2')+ "\n";

	content += "\n11.Noisy respirations\n";
	content += "\t11.1 Noisy breathing present:" + getValueForReport('breathing')+ "\n";
	content += "\t11.2 Excessive respiratory secretions present:" + getValueForReport('secretions')+ "\n";
	content += "\t11.3 Level of consciousness:" + getValueForReport('conscious')+ "\n";

	content += "\n12.Crisis medications\n";
	content += "\t12.1  Potential for seizure or significant haemorrhage or acute respiratory distress:" + getValueForReport('seizure')+ "\n";

	return content;
}
function clearApo()
{
 localStorage.setItem('bookmark', '');
 localStorage.setItem('patient', '');
 localStorage.setItem('textdoku', '');
}

function clearLCP()
{
    localStorage.setItem('bookmarkL', '');
}
