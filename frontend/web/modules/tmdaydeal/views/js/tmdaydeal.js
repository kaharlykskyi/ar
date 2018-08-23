function findCombination()
{$('#minimal_quantity_wanted_p').fadeOut();if(typeof $('#minimal_quantity_label').text()==='undefined'||$('#minimal_quantity_label').html()>1)
$('#quantity_wanted').val(1);var choice=[];var radio_inputs=parseInt($('#attributes .checked > input[type=radio]').length);if(radio_inputs)
radio_inputs='#attributes .checked > input[type=radio]';else
radio_inputs='#attributes input[type=radio]:checked';$('#attributes select, #attributes input[type=hidden], '+ radio_inputs).each(function(){choice.push(parseInt($(this).val()));});if(typeof combinationsHashSet!=='undefined'){var combination=combinationsHashSet[choice.sort().join('-')];if(combination)
{if(combination['minimal_quantity']>1)
{$('#minimal_quantity_label').html(combination['minimal_quantity']);$('#minimal_quantity_wanted_p').fadeIn();$('#quantity_wanted').val(combination['minimal_quantity']);$('#quantity_wanted').bind('keyup',function(){checkMinimalQuantity(combination['minimal_quantity']);});}
selectedCombination['unavailable']=false;selectedCombination['reference']=combination['reference'];$('#idCombination').val(combination['idCombination']);quantityAvailable=combination['quantity'];selectedCombination['price']=combination['price'];if(selectedCombination['price']!=0)
{$('.daydeal-box-product').addClass('act');}
else
{$('.daydeal-box-product').removeClass('act')}
selectedCombination['unit_price']=combination['unit_price'];selectedCombination['specific_price']=combination['specific_price'];if(combination['ecotax'])
selectedCombination['ecotax']=combination['ecotax'];else
selectedCombination['ecotax']=default_eco_tax;if(combination['image']&&combination['image']!=-1)
displayImage($('#thumb_'+ combination['image']).parent());if(combination['idCombination']&&combination['idCombination']>0)
displayDiscounts(combination['idCombination']);selectedCombination['available_date']=combination['available_date'];updateDisplay();if(firstTime)
{refreshProductImages(0);firstTime=false;}
else
refreshProductImages(combination['idCombination']);return;}}
selectedCombination['unavailable']=true;if(typeof(selectedCombination['available_date'])!=='undefined')
delete selectedCombination['available_date'];updateDisplay();}