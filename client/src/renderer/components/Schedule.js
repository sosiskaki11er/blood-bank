import React, { useState } from 'react'
import Appointments from './Appointments'

function Schedule({role}) {
  const [date, setDate] = useState('')
  const [time, setTime] = useState('')
  const [hospital, setHospital] = useState('')
  const [doctor, setDoctor] = useState('')
  const [donationType, setDonationType] = useState('')
  console.log(role)
  const HandleDonationType = (type) => {
    setDonationType(type)
  }
  return (
    <div className='subpage'>
      <Appointments role={role}/>
      {
        (role === 'patient' || role === 'Donor') &&
                <div className='component max-w-[684px]'>
            <h3>Schedule appointment</h3>
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
                        <div className='container flex-grow-[1] flex-col'>
                            <h4 className='input-header'>Hospital*</h4>
                            <select value={hospital} onChange={(e) => setHospital(e.target.value)}>
                                <option>DoctorMim</option>
                            </select>
                        </div>
                        {
                            (role === 'patient') &&
                            <div className='container flex-grow-[1] flex-col max-w-[332px]'>
                                <h4 className='input-header'>Doctor’s Name*</h4>
                                <select value={doctor} onChange={(e) => setDoctor(e.target.value)}>
                                    <option>Garrick Fennimore</option>
                                </select>
                            </div>
                        }
                    </div>
                        {
                            (role === 'Donor') &&
                            <div className='container flex-col gap-[16px]'>
                                <h4 className='input-header'>Choose donation type:</h4>
                                <div className="container gap-[8px] flex-wrap">
                                    <div className={donationType === "Charity" ? "role-tab active w-[196px]" : "role-tab w-[196px]"} onClick={(e) => HandleDonationType('Charity')}>Charity</div>
                                    <div className={donationType === "Paid" ? "role-tab active w-[196px]" : "role-tab w-[196px]"} onClick={(e) => HandleDonationType('Paid')}>Paid</div>
                                </div>
                            </div> 
                        }
                    <button>Submit</button>
                </div>      
        </div>
      }

    </div>
  )
}

export default Schedule