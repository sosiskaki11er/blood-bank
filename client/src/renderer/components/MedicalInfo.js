import React from 'react'

function MedicalInfo() {
  return (
    <div className='component max-w-[684px]'>
          <h3>Medical information</h3>
          <div className='container flex-col gap-[24px]'>
                <div className='flex gap-[12px] justify-between'>
                    <div className='container flex-col flex-grow-[1] max-w-[332px]'>
                        <h4 className='input-header'>Blood type</h4>
                        <select disabled>
                            <option>A</option>
                            <option>B</option>
                            <option>O</option>
                            <option>AB</option>
                        </select>
                    </div>
                    <div className='container flex-col flex-grow-[1] max-w-[332px]'>
                        <h4 className='input-header'>Rhesus</h4>
                        <select disabled>
                            <option>+</option>
                            <option>-</option>
                        </select>
                    </div>
                </div>
                <div className='container flex-col'>
                    <h4 className='input-header'>Diseases</h4>
                    <input type='text' disabled/>
                </div>
                <div className='container flex-col'>
                    <h4 className='input-header'>Amount of Blood (ml)</h4>
                    <input type='text' disabled/>
                </div>
                <p className='text-sm text-grey-600'>Oops! Looks like only our trusted doctors and nurses have the superpowers to update your medical info. Please reach out to them for any changes you need.</p>
          </div>
        </div>
  )
}

export default MedicalInfo