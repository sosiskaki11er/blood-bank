import React, { useState } from 'react'
import MedicalInfo from './MedicalInfo'

function Request() {
  const [date, setDate] = useState('')
  const [time, setTime] = useState('')
  const [hospital, setHospital] = useState('')
  const [ID, setID] = useState('')

  return (
    <div className='subpage'>
        <div className='component max-w-[684px]'>
          <h3>Choose date & Hospital</h3>
          <div className='container flex-col gap-[24px]'>
                <div className='flex gap-[20px]'>
                    <div className='container flex-grow-[1] flex-col max-w-[332px]'>
                        <h4 className='input-header'>Date of appointment*</h4>
                        <input type='date' value={date} onChange={(e) => setDate(e.target.value)}/>
                    </div>
                    <div className='container flex-grow-[1] flex-col max-w-[332px]'>
                        <h4 className='input-header'>Time of appointment*</h4>
                        <input type='time' value={time} onChange={(e) => setTime(e.target.value)}/>
                    </div>
                </div>
                <div className='flex gap-[20px]'>
                    <div className='container flex-grow-[1] flex-col max-w-[332px]'>
                        <h4 className='input-header'>Hospital*</h4>
                        <select value={hospital} onChange={(e) => setHospital(e.target.value)}>
                            <option>DoctorMim</option>
                        </select>
                    </div>
                    <div className='container flex-grow-[1] flex-col max-w-[332px]'>
                        <h4 className='input-header'>Prescription ID*</h4>
                        <select value={ID} onChange={(e) => setID(e.target.value)}>
                            <option>DM12461234</option>
                        </select>
                    </div>
                </div>
            </div>      
        </div>
        <MedicalInfo/>
    </div>
  )
}

export default Request