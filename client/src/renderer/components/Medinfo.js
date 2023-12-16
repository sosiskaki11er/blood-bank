import React from 'react'
import ReqIcon from '../assets/icons/request.svg'
import BloodImg from '../assets/img/blood.png'

function Medinfo({handleSubpage}) {
  return (
<div className='component'>
        <h3>Medical information</h3>
        <div className='container gap-[20px]'>
            <div className='card gap-[32px]'>
                <img src={BloodImg} className='w-[96px] h-[96px]'/>
                <div className='container gap-[24px]'>
                    <div className='container flex-col text-grey-700 my-auto gap-[12px]'>
                        <h3 className='text-base'>Blood Type:</h3>
                        <h3 className='text-base'>Rhesus:</h3>
                        <h3 className='text-base'>Diseases:</h3>
                    </div>
                    <div className='container flex-col my-auto gap-[12px]'>
                        <h3 className='text-base'>A</h3>
                        <h3 className='text-base'>+</h3>
                        <h3 className='diseases text-base'>AID, efvdfvergtrgtr</h3>
                    </div>
                </div>
            </div>

            <div 
            className='add-tab'
            onClick={() => handleSubpage('request')}
            >
                <img src={ReqIcon}/>
                <h3 >Request blood transfusion</h3>
            </div>
        </div>
    </div>
  )
}

export default Medinfo